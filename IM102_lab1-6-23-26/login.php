<?php
include 'config.php';
include 'auth.php';

if (isLoggedIn()) {
    header("Location: index1.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: index1.php");
        exit;

    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<body>

<div class="container">

    <div class="logo">
        <h1>InventoryPro</h1>
        <p>Inventory Management System</p>
    </div>

    <h2>Welcome Back</h2>

    <?php if($error): ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">
            Sign In
        </button>

    </form>

    <div class="auth-link">
        Don't have an account?
        <a href="register.php">Register</a>
    </div>

</div>

</body>

</body>
</html>