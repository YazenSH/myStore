<?php
include '../db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    $errors = array();
    
    // Validate inputs
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $description = trim($_POST['description']);
    
    // Name validation
    if (strlen($name) < 2) {
        $errors[] = "Product name must be at least 2 characters";
    }
    
    // Price validation
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be greater than 0";
    }
    
    // Description validation
    if (strlen($description) < 10) {
        $errors[] = "Description must be at least 10 characters";
    }
    
    // Image validation
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $errors[] = "Please select an image";
    } else {
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed)) {
            $errors[] = "Please upload an image file (jpg, jpeg, png, gif)";
        }
    }
    
    if (empty($errors)) {
        $target_dir = "../Images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_path = "Images/" . basename($_FILES["image"]["name"]);
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdss", $name, $price, $description, $image_path);
            
            if ($stmt->execute()) {
                header("Location: ../pages/admin.php?success=added");
            } else {
                header("Location: ../pages/admin.php?error=failed");
            }
            $stmt->close();
        } else {
            header("Location: ../pages/admin.php?error=upload");
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../pages/admin.php?error=validation");
    }
}
$conn->close();
?>