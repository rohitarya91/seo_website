<?php
require_once __DIR__ . '/../config/store.php';

$error = [];
$flash = get_flash();

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error[] = "Please fill all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Enter a valid email.";
    } else {
        $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                if ($user['email'] === "admin@gmail.com") {
                    redirect_to("../dashboard/dashboard.php");
                }

                redirect_to("../dashboard/user_dashboard.php");
            } else {
                $error[] = "Invalid email or password.";
            }
        } else {
            $error[] = "Invalid email or password.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
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
                <h1>Welcome Back</h1>
                <p>Please login to your account</p>
            </div>

            <form class="login-form" id="loginForm" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="loginEmail" name="email" placeholder="Enter your email" required value="<?php echo e($_POST['email'] ?? ''); ?>">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-pw" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <?php if ($flash): ?>
                    <span class="success-msg"><?php echo e($flash['message']); ?></span>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <span class="error-msg"><?php echo e(implode(' ', $error)); ?></span>
                <?php endif; ?>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" id="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-pw">Forgot password?</a>
                </div>

                <button type="submit" name="login" class="login-btn">
                    <span>Login</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="divider">
                    <span>or continue with</span>
                </div>

                <div class="social-login">
                    <button type="button" class="social-btn google">
                        <i class="fa-brands fa-google"></i>
                    </button>
                    <button type="button" class="social-btn github">
                        <i class="fab fa-github"></i>
                    </button>
                    <button type="button" class="social-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                </div>

                <p class="signup-link">Don't have an account? <a href="./register.php" id="signupLink">Sign up</a></p>
            </form>
        </div>
    </div>
</body>

</html>
