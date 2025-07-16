<?php
require_once '../../bootstrap.php';

$pageTitle = 'Login';
$pageName = 'login';
$navbarType = 'default';
$headerType = 'none';

ob_start();
?>

<main class="login-container">
    <div class="login-box fade-in-section">
        <h2>Welcome Back, Bender</h2>

        <form action="/handlers/loginUser.handler.php" method="POST" class="login-form">
            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error-message"><?= htmlspecialchars($_SESSION['login_error']) ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['login_success'])): ?>
                <div class="success-message"><?= htmlspecialchars($_SESSION['login_success']) ?></div>
                <?php unset($_SESSION['login_success']); ?>
            <?php endif; ?>

            <button type="submit" class="explore-btn">Log In</button>
            <p class="register-link">Don't have an account? <a href="/pages/registerPage/index.php">Register</a></p>
        </form>
    </div>
</main>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';
?>