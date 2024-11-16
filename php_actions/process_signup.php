<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    
    // Validate name (letters and spaces only, at least 2 characters)
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (!preg_match("/^[A-Za-z\s]{2,}$/", $name)) {
        $errors[] = "Name should only contain letters and spaces and be at least 2 characters long";
    }

    // Validate and clean email
    $email = strtolower(trim($_POST['email']));
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        // Check if email exists
        $check_email = "SELECT email FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Email already exists";
        }
        $stmt->close();
    }

    // Validate password
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        $hashed_password = md5($password);
        
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $hashed_password);
            
            if ($stmt->execute()) {
                echo "<script>
                        alert('Registration successful! Please login.');
                        window.location.href='../pages/login.php';
                      </script>";
            } else {
                throw new Exception("Database error");
            }
        } catch (Exception $e) {
            echo "<script>
                    alert('Error occurred. Please try again.');
                    window.history.back();
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
    }
}
$conn->close();
?>