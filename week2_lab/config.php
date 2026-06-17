<?php
// Enable full error reporting for debugging (remove or reduce on production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Turn mysqli into exceptions so we can see the real error
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username   = "root";
$password   = ""; // leave empty if root has no password
$dbname     = "inventory_db";
$port       = 3307; // default MySQL port, change if you use a different port

try {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Clear, actionable error message
    http_response_code(500);
    echo "Database connection failed: (" . $e->getCode() . ") " . htmlspecialchars($e->getMessage());
    exit;
}
