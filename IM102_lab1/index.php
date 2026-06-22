<?php
include 'auth.php';
requireLogin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Dashboard</h2>

    <p class="success">
        Welcome, <?php echo getUsername(); ?>!
    </p>

    <p>You are successfully logged in.</p>

    <a href="report.php">View Report</a>
    <br><br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>