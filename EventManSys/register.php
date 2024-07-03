<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';
require 'classes/User.php';
require 'classes/Database.php';

$usernameError = '';
$passwordError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $result = $user->register($_POST['username'], $_POST['password'], $_POST['email']);
    if (!$result['success']) {
        if ($result['message'] === 'Nickname already used') {
            $usernameError = $result['message'];
        } else {
            $passwordError = $result['message'];
        }
    } else {
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Register</h1>
        <form action="register.php" method="post" class="mt-4">
            <div class="form-group">
                <input type="text" name="username" class="form-control <?php echo $usernameError ? 'is-invalid' : ''; ?>" placeholder="Username" required>
                <?php if ($usernameError): ?>
                    <div class="invalid-feedback"><?php echo $usernameError; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control <?php echo $passwordError ? 'is-invalid' : ''; ?>" placeholder="Password" required>
                <?php if ($passwordError): ?>
                    <div class="invalid-feedback"><?php echo $passwordError; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Login</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
