<?php
$host = getenv("MYSQLHOST");
$username = "root";  // Railway uses root by default
$password = getenv("MYSQLPASSWORD");
$dbname = "railway"; // Railway's default database name
$port = getenv("MYSQLPORT");

// Check if environment variables are set
if (!$host || !$password || !$port) {
    die("Required environment variables are not set.");
}

try {
    // Create the connection
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Remove or comment out this line in production
    // echo "Connection successful!";
    
} catch(Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>