<?php
require_once '../config/bootstrap.php';
if (auth_id()) {
    _redirect(BASE_URL_PUBLIC.'dashboard');
}
$username = $email = $password = $confirmPassword = '';
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Server-side validation
    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = DB::queryFirstRow("SELECT * FROM users WHERE (username = %s or email = %s )", $username, $email);
        if(!empty($user)){
            $error = "email address or username is already used!";
        } else {
            // Insert the new user into the database
            DB::insert('users', [
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword
            ]);
            _redirect(BASE_URL_PUBLIC,'Registration successful!','success');
        }
        
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo PROJECT_NAME; ?>: Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link href="<?php echo BASE_URL_PUBLIC . 'assets/css/custom.css'; ?>" rel="stylesheet">
    </head>
    <body class="register-page">
        <div class="container mt-5">
            <div class="form-container">
                <h3 class="text-center">Create Account</h3>

                 <?= _flash_message() ?>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form method="post" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required minlength="3" placeholder="Enter Username" value="<?php echo $username; ?>">
                        <div class="invalid-feedback">Username is required and must be at least 3 characters long.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter Email" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6" placeholder="Enter Password" value="<?php echo $password; ?>">
                        <div class="invalid-feedback">Password must be at least 6 characters long.</div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm Password" value="<?php echo $confirmPassword; ?>">
                        <div class="invalid-feedback">Please confirm your password.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="index.php">Login</a></p>
            </div>
        </div>
    </body>
</html>