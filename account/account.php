<?php
require_once __DIR__ . '/../config/store.php';

require_login();

$name = current_user_name();
$email = current_user_email();
$role = is_admin() ? 'Admin' : 'User';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="page">
    <div class="page-shell">
        <aside class="glass-panel side-panel">
            <div class="profile-card">
                <div class="profile-avatar"><?php echo e(get_avatar_letter($name)); ?></div>
                <h3><?php echo e($name); ?></h3>
                <p class="muted"><?php echo e($role); ?></p>
            </div>

            <ul class="nav-list">
                <li><a href="../dashboard/user_dashboard.php"><i class="fa-solid fa-house"></i> Back to Dashboard</a></li>
                <li><a href="../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </aside>

        <main class="glass-panel main-panel">
            <div class="panel-header">
                <div class="panel-title">
                    <h1>My Account</h1>
                    <p class="muted">Your profile details and account settings.</p>
                </div>
            </div>

            <div class="content-card">
                <div class="data-row">
                    <span class="muted">Name</span>
                    <strong><?php echo e($name); ?></strong>
                </div>
                <div class="data-row">
                    <span class="muted">Email</span>
                    <strong><?php echo e($email); ?></strong>
                </div>
                <div class="data-row">
                    <span class="muted">Role</span>
                    <strong><?php echo e($role); ?></strong>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
