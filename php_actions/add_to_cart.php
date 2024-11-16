<?php
session_start();
include '../db/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    header("Location: ../pages/products.php?error=admin_cart");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    
    // Check if product exists
    $check_product = "SELECT product_ID FROM products WHERE product_ID = ?";
    $stmt = $conn->prepare($check_product);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        header("Location: ../pages/products.php?error=invalid_product");
        exit();
    }
    
    // Check if product is already in cart
    $check_cart = "SELECT quantity FROM cart WHERE user_ID = ? AND product_ID = ?";
    $stmt = $conn->prepare($check_cart);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;
        if ($new_quantity > 10) {
            header("Location: ../pages/products.php?error=max_quantity");
            exit();
        }
        $sql = "UPDATE cart SET quantity = ? WHERE user_ID = ? AND product_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
    } else {
        // Add new item
        $sql = "INSERT INTO cart (user_ID, product_ID, quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
    }
    
    if ($stmt->execute()) {
        header("Location: ../pages/products.php?success=added");
    } else {
        header("Location: ../pages/products.php?error=failed");
    }
    $stmt->close();
}
$conn->close();
?>