<?php
// C:\Users\LENOVO\Documents\GitHub\myStore\php_actions\search_products.php

function searchProducts($conn, $searchTerm) {
    // Clean the input first
    $searchTerm = htmlspecialchars(trim($searchTerm));
    
    if (empty($searchTerm)) {
        return null;
    }
    
    // Prepare for database search
    $searchTerm = '%' . $conn->real_escape_string($searchTerm) . '%';
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    return $result;
}
?>