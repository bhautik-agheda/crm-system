<?php
require_once '../config/bootstrap.php';

if (auth_id()) {
    _redirect(BASE_URL_PUBLIC.'dashboard');
}
$username = $password = '';
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Server-side validation
    if (empty($username) || empty($password)) {
        $error = "Both fields are required!";
    } else {
        // Fetch the user data from the database
        $user = DB::queryFirstRow("SELECT * FROM users WHERE (username = %s or email = %s )", $username, $username);

        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, log the user in
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            _redirect(BASE_URL_PUBLIC.'dashboard');
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo PROJECT_NAME; ?>: Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link href="<?php echo BASE_URL_PUBLIC . 'assets/css/custom.css'; ?>" rel="stylesheet">
    </head>
    <body class="login-page">
        <div class="container mt-5">
            <div class="form-container">
                <h2 class="text-center">Admin Login</h2>

                 <?= _flash_message() ?>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form method="post" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required placeholder="Enter Username" value="<?php echo $username; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter Password" value="<?php echo $password; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? <a href="register.php">Create one</a></p>
            </div>
        </div>
    </body>
</html>