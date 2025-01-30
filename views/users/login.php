<?php

use App\Classes\Database;
use App\Classes\Query;
use App\Classes\Redirect;
use App\Classes\SessionManager;

SessionManager::start();

$message = "";
$toastClass = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($password) || empty($username)) {
        $message = "All fields are required.";
        $toastClass = "bg-danger";
    } else {
        // Initialize database connection
        $db = (new Database())->getConnection();
        $query = new Query($db);

        // Check if email exists in the database
        $user = $query->find('users', $username, 'username', true);

        if ($user) {
            // Validate password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                SessionManager::set('username', $user['username']);
                SessionManager::set('email', $email);
                SessionManager::set('user_id', $user['UserID']);
                SessionManager::set('role', $user['role']);

                // Redirect based on role
                if ($user['role'] === 'Admin') {
                    Redirect::redirect('/admin');
                } else {
                    Redirect::redirect('/');
                }
                exit();
            } else {
                $message = "Incorrect password.";
                $toastClass = "bg-danger";
            }
        } else {
            $message = "Username not found.";
            $toastClass = "bg-warning";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body class="bg-light">
    <div class="container p-5 d-flex flex-column align-items-center">
        <?php if ($message): ?>
            <div class="toast align-items-center text-white <?= $toastClass; ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $message; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="form-control mt-5 p-4" style="height:auto; width:380px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row">
                <h5 class="text-center p-4" style="font-weight: 700;">Login Into Your Account</h5>
            </div>
            <div class="col-mb-3">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" class="form-control" required>
            </div>
            <div class="col mb-3 mt-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col mb-3 mt-3">
                <button type="submit" class="btn btn-success bg-success" style="font-weight: 600;">Login</button>
            </div>
            <div class="col mb-2 mt-4">
                <p class="text-center" style="font-weight: 600; color: navy;">
                    <a href="./register" style="text-decoration: none;">Create Account</a>
                     <!-- OR <a href="/resetpassword" style="text-decoration: none;">Forgot Password</a> -->
                </p>
            </div>
        </form>
    </div>
</body>
</html>
