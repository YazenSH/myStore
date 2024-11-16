<?php
include '../db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    $errors = array();
    
    // Create uploads directory if it doesn't exist
    $target_dir = "../public/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
        chmod($target_dir, 0777);
    }
    
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
        // Generate unique filename to prevent overwriting
        $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $image_path = "public/uploads/" . $file_name;
        
        try {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert into database
                $sql = "INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdss", $name, $price, $description, $image_path);
                
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Product added successfully";
                    header("Location: ../pages/admin.php");
                    exit();
                } else {
                    throw new Exception("Database error");
                }
                $stmt->close();
            } else {
                throw new Exception("Error uploading file");
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header("Location: ../pages/admin.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../pages/admin.php");
        exit();
    }
}

// If not POST request or not admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../pages/index.php");
    exit();
}

$conn->close();
?>