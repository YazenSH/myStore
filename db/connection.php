<?php
// Get the MySQL URL from the environment variable
$mysql_url = getenv("MYSQL_URL");

// Parse the URL to get components
$parts = parse_url($mysql_url);

$host = $parts['host'];
$username = $parts['user'];
$password = $parts['pass'];
$dbname = ltrim($parts['path'], '/');
$port = $parts['port'];

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>