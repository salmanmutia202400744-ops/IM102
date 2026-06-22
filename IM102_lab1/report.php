<?php
include 'auth.php';
requireLogin();
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

    <p>This page can only be accessed by logged-in users.</p>

    <p>Current User: <strong><?php echo getUsername(); ?></strong></p>

    <br>

    <a href="index.php">Back to Dashboard</a>
</div>

</body>
</html>