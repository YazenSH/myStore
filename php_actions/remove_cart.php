<?php
session_start();
include '../db/connection.php';

if (!isset($_SESSION['user_id']) || (isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1)) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM cart WHERE user_ID = ? AND product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);

    if ($stmt->execute()) {
        header("Location: ../pages/cart.php?success=removed");
    } else {
        header("Location: ../pages/cart.php?error=remove_failed");
    }
    $stmt->close();
}
$conn->close();
?>