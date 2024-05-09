<?php

// Database connection settings
$dsn = "mysql:host=localhost;dbname=ccdb";
$username = "root"; // your MySQL username
$password = ""; // your MySQL password

$database = "ccdb"; // your database name

try {
    // Establish database connection using PDO
    $conn = new PDO($dsn, $username, $password);
    // Set PDO to throw exceptions on error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
// Handle database connection errors
echo "Connection failed: " . $e->getMessage();
}
