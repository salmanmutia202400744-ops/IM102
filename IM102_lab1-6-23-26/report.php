<?php
require_once 'auth.php';
requireLogin();
requireAdmin();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Protected Report</h2>

    <p>This page can only be accessed by admins.</p>

    <p>Current User: <strong><?php echo getUsername(); ?></strong></p>

    <br>

    <a href="index1.php">Back to Dashboard</a>
</div>

</body>
</html>