<?php
// config.php
$host = 'localhost';    // Server address
$user = 'root';         // MySQL username
$pass = '';             // MySQL password (empty by default in XAMPP)
$db   = 'im102_lab2';     // Database name

$conn = new mysqli($host, $user, $pass, $db);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8mb4");
?>