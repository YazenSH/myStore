<?php
include '../db/connection.php';
session_start();

// Check if user is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../pages/index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    
    // Get and validate inputs
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $description = trim($_POST['description']);
    
    // Price validation
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be greater than 0";
    }
    
    // Description validation
    if (strlen($description) < 10) {
        $errors[] = "Description must be at least 10 characters";
    }
    
    if (empty($errors)) {
        try {
            $sql = "UPDATE products SET price = ?, description = ? WHERE product_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dsi", $price, $description, $product_id);
            
            if ($stmt->execute()) {
                header("Location: ../pages/admin.php?success=updated");
                exit();
            } else {
                throw new Exception("Update failed");
            }
            
        } catch (Exception $e) {
            header("Location: ../pages/admin.php?error=" . urlencode($e->getMessage()));
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../pages/admin.php?error=validation");
        exit();
    }
}

$conn->close();
?>