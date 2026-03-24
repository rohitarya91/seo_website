<?php
require_once __DIR__ . '/../config/store.php';

$errors = [];

if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name === '' || $email === '' || $password === '') {
        $errors[] = 'Please fill all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    } else {
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->bind_param('s', $email);
        $checkStmt->execute();
        $exists = $checkStmt->get_result()->num_rows > 0;
        $checkStmt->close();

        if ($exists) {
            $errors[] = 'Email already registered.';
        } else {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
            $stmt->bind_param('sss', $name, $email, $pass);

            if ($stmt->execute()) {
                $stmt->close();
                set_flash('success', 'Registration successful. Please login.');
                redirect_to('login.php');
            }

            $stmt->close();
            $errors[] = 'Unable to register right now.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="auth-page">
    <div class="login-container">
        <div class="login-glass">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-rocket"></i>
                    <span>Harvest Fresh</span>
                </div>
                <h1>Create Account</h1>
                <p>Start your journey with us</p>
            </div>

            <form class="login-form" id="signupForm" method="post">
                <div class="input-group">
                    <label for="name">Name</label>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo e($_POST['name'] ?? ''); ?>" />
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo e($_POST['email'] ?? ''); ?>" />
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Create a password" />
                        <button type="button" class="toggle-pw" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <?php if (!empty($errors)): ?>
                    <span class="error-msg"><?php echo e(implode(' ', $errors)); ?></span>
                <?php endif; ?>

                <button type="submit" name="register" class="login-btn">
                    <span>Register</span>
                    <i class="fas fa-user-plus"></i>
                </button>

                <div class="divider">
                    <span>or continue with</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-btn google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="social-btn github">
                        <i class="fab fa-github"></i>
                    </button>
                    <button type="button" class="social-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                </div>

                <p class="signup-link">Already have an account? <a href="./login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>
