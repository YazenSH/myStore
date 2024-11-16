<?php
$host = getenv("MYSQLHOST");
$username = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$dbname = getenv("MYSQL_DATABASE");
$port = getenv("MYSQLPORT");

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>