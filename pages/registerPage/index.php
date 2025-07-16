<?php
require_once '../../bootstrap.php';

$pageTitle = 'Register';
$pageName = 'register';
$headerType = 'none';
$navbarType = 'default';

$registerError = $_SESSION['register_error'] ?? '';
$registerSuccess = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_error'], $_SESSION['register_success']);

$metaRedirect = $registerSuccess ? '<meta http-equiv="refresh" content="2;url=/pages/loginPage/index.php">' : '';

ob_start();
?>

<main class="register-container">
    <div class="register-box fade-in-section">
        <h2>Create Bender</h2>
        <form class="register-form" action="/handlers/registerUser.handler.php" method="post" autocomplete="off">
            <!-- Fields here -->
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <?php if ($registerError): ?>
                <div class="error-message"><?= htmlspecialchars($registerError) ?></div>
            <?php endif; ?>
            <?php if ($registerSuccess): ?>
                <div class="success-message"><?= htmlspecialchars($registerSuccess) ?></div>
            <?php endif; ?>

            <button type="submit" class="register-btn">Register</button>
        </form>
        <p class="login-link">Already have an account? <a href="/pages/loginPage/index.php">Login here</a></p>
    </div>
</main>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';