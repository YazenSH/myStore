<?php

$database_url = getenv("MYSQL_URL");

try {
    // Parse the URL
    $db_url = parse_url($database_url);

    // Extract connection details
    $host = $db_url["host"];
    $dbname = ltrim($db_url["path"], '/');
    $username = $db_url["user"];
    $password = $db_url["pass"];
    $port = $db_url["port"];

    // Establish connection
    $conn = mysqli_connect($host, $username, $password, $dbname, $port);

    // Set charset for proper encoding
    mysqli_set_charset($conn, "utf8mb4");

    // Check connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    // Log error (don't show database details in production)
    error_log("Database connection error: " . $e->getMessage());
    die("Could not connect to the database. Please try again later.");
}
?>