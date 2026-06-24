<?php
require_once 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    $stmt = $conn->prepare(
        "SELECT id FROM users WHERE username = ? OR email = ?"
    );
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Username or Email already exists.";
    }

    if (empty($errors)) {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users(username,email,password_hash)
             VALUES(?,?,?)"
        );

        $stmt->bind_param(
            "sss", 
            $username,
            $email,
            $password_hash
        );

        if ($stmt->execute()) {
            $message = "Registration Successful!";
            $message_class = "success";
        } else {
            $message = "Registration Failed!";
            $message_class = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="auth.css">
<head>
    <title>Register</title>
</head>
 <link rel="stylesheet" href="style.css">
<body>
<div class="container">
<div class="logo">InventoryPro</div>
<h2>Create Account</h2>
<p class="subtitle">Register a new user account</p>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
    echo "<p class='error'>$error</p>";
    }
}
?>
<?php if (!empty($message)) : ?>
    <p class="<?php echo $message_class; ?>">
        <?php echo $message; ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>Username</label>
    <input type="text" name="username">

    <label>Email</label>
    <input type="email" name="email">

    <label>Password</label>
    <input type="password" name="password">

    <label>Confirm Password</label>
    <input type="password" name="confirm_password">

    <button type="submit">Register</button>

</form>
<div class="auth-link">
    Already have an account?
    <a href="login.php">Login</a>
</div>

</div>

</body>
</html>