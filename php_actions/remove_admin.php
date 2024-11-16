<?php
include '../db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['is_admin']) && $_SESSION['is_admin']==1) {
    $admin_id = $_POST['admin_id'];
    
    $sql = "UPDATE users SET isAdmin = 0 WHERE user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    
    if ($stmt->execute()) {
        header("Location: ../pages/admin.php?success=removed");
    } else {
        header("Location: ../pages/admin.php?error=failed");
    }
    $stmt->close();
}
$conn->close();
?>