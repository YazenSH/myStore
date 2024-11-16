<?php
$servername = "localhost";  // Copy from MYSQLHOST
$username = "root";      // Copy from MYSQLUSER
$password = "";      // Copy from MYSQLPASSWORD
$dbname = "store";        // Copy from MYSQL_DATABASE
$port = "3306";             // Copy from MYSQLPORT

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>