
<?php
use App\Classes\Database;
use App\Classes\Query;
use App\Classes\SessionManager;
use App\Classes\Redirect;

$message = "";
$toastClass = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
   {

// Start the session
SessionManager::start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Initialize database connection
    $db = (new Database())->getConnection();
    $query = new Query($db);

    // Check if the email already exists
    $existingUser = $query->find('users', $email, 'email', true);

    if ($existingUser) {
        $message = "Email is already registered";
        $toastClass = "bg-warning";
    } else {
        // Insert the new user into the database
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ];

        $insertSuccess = $query->insert('users', $data);

        if ($insertSuccess) {
            $message = "Registration successful!";
            $toastClass = "bg-success";
            // Redirect to login page after successful registration
            Redirect::redirect('/login');
            exit();
        } else {
            $message = "Error registering user";
            $toastClass = "bg-danger";
        }
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
    <title>Register</title>
</head>
<body class="bg-light">
    <div class="container p-5 d-flex flex-column align-items-center">
        <?php if ($message): ?>
            <div class="toast align-items-center text-white <?php echo $toastClass; ?>" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $message; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="form-control mt-5 p-4" style="height:auto; width:380px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row">
                <h5 class="text-center p-4" style="font-weight: 700;">Create Account</h5>
            </div>
            <div class="col-mb-3">
            <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="col-mb-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="col mb-3 mt-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="col mb-3 mt-3">
                <button type="submit" class="btn btn-success bg-success" style="font-weight: 600;">Register</button>
            </div>
            <div class="col mb-2 mt-4">
                <p class="text-center" style="font-weight: 600; color: navy;">
                    <a href="/login" style="text-decoration: none;">Already have an account? Login</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
