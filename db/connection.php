<?php
// Get the MySQL URL from the environment variable
$mysql_url = getenv("MYSQL_PUBLIC_URL"); // Use the actual environment variable name here

if (!$mysql_url) {
    die("Environment variable 'MYSQL_PUBLIC_URL' not set.");
}

// Parse the URL to get components
$parts = parse_url($mysql_url);

$host = $parts['host'];
$username = $parts['user'];
$password = $parts['pass'];
$dbname = ltrim($parts['path'], '/');
$port = isset($parts['port']) ? $parts['port'] : 3306; // Default MySQL port

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!";
?>
