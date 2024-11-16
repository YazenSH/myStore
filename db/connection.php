<?php
$host = "mysql.railway.internal";  // Copy from MYSQLHOST
$username = "root";      // Copy from MYSQLUSER
$password = "xDyETSPdXxQcgaLySbAOLRoiwidUIWzm";      // Copy from MYSQLPASSWORD
$dbname = "railway";        // Copy from MYSQL_DATABASE
$port = "3306";             // Copy from MYSQLPORT

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>