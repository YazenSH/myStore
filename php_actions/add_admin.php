<?php
include '../db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    $errors = array();
    
    // Validate inputs
    $name = trim($_POST['admin_name']);
    $email = strtolower(trim($_POST['admin_email']));
    $password = $_POST['admin_password'];
    
    // Name validation
    if (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters";
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        // Check if email exists
        $check_sql = "SELECT email FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        if ($check_stmt->get_result()->num_rows > 0) {
            $errors[] = "Email already exists";
        }
        $check_stmt->close();
    }
    
    // Password validation
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if (empty($errors)) {
        $hashed_password = md5($password);
        
        $sql = "INSERT INTO users (name, email, password, isAdmin) VALUES (?, ?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            header("Location: ../pages/admin.php?success=added");
        } else {
            header("Location: ../pages/admin.php?error=failed");
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../pages/admin.php?error=validation");
    }
}
$conn->close();
?>