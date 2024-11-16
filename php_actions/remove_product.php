<?php
include '../db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    $product_id = $_POST['product_id'];
    
    $sql = "DELETE FROM products WHERE product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        header("Location: ../pages/admin.php?success=removed");
    } else {
        header("Location: ../pages/admin.php?error=failed");
    }
    $stmt->close();
}
$conn->close();
?>