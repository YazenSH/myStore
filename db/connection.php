<?php
    // Database URL (replace with your actual URL)
    $database_url = "mysql://root:xDyETSPdXxQcgaLySbAOLRoiwidUIWzm@autorack.proxy.rlwy.net:51658/railway";

    // Parse the URL
    $db_url = parse_url($database_url);

    $host = $db_url["host"];
    $dbname = ltrim($db_url["path"], '/');
    $username = $db_url["user"];
    $password = $db_url["pass"];
    $port = 3306;

    // Establish a connection to the MySQL database
    $conn = mysqli_connect($host, $username, $password, $dbname, $port);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
