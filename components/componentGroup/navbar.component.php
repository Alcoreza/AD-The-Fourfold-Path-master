<nav class="navbar">
    <div class="nav-brand">The Fourfold Path</div>
    <ul class="nav-links">
        <li><a href="/index.php">Home</a></li>
        <li><a href="/pages/productPage/index.php">Products</a></li>
        <li><a href="/pages/cartPage/index.php">Cart</a></li>
        <li><a href="/pages/aboutPage/index.php">About</a></li>

        <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-welcome">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</li>
            <li><a href="/handlers/logoutUser.handler.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/pages/loginPage/index.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
