<?php
session_start();
include '../db/connection.php';

if (!isset($_SESSION['user_id']) || (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1)) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate quantity
    if ($quantity < 1 || $quantity > 10) {
        header("Location: ../pages/cart.php?error=invalid_quantity");
        exit();
    }

    $sql = "UPDATE cart SET quantity = ? WHERE user_ID = ? AND product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);

    if ($stmt->execute()) {
        header("Location: ../pages/cart.php?success=updated");
    } else {
        header("Location: ../pages/cart.php?error=update_failed");
    }
    $stmt->close();
}
$conn->close();
?>