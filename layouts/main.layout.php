<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | The Fourfold Path' : 'The Fourfold Path' ?></title>

    <?php if (isset($metaRedirect)) echo $metaRedirect; ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">

    <!-- Global Styles -->
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- Page-Specific CSS -->
    <?php if (isset($pageName)) : ?>
        <?php if ($pageName === 'about'): ?>
            <link rel="stylesheet" href="/pages/aboutPage/assets/css/about.css">
        <?php elseif ($pageName === 'cart'): ?>
            <link rel="stylesheet" href="/pages/cartPage/assets/css/cart.css">
        <?php elseif ($pageName === 'login'): ?>
            <link rel="stylesheet" href="/pages/loginPage/assets/css/login.css">
        <?php elseif ($pageName === 'register'): ?>
            <link rel="stylesheet" href="/pages/registerPage/assets/css/register.css">
        <?php endif; ?>
    <?php endif; ?>
</head>

<body class="<?= isset($pageName) ? $pageName . '-page' : '' ?>">

<?php
// Header handling
if (!isset($headerType) || $headerType !== 'none') {
    require_once COMPONENTS_PATH . '/header.component.php';
}

// Navbar handling
if (!isset($navbarType) || $navbarType !== 'none') {
    require_once COMPONENTS_PATH . '/navbar.component.php';
}
?>

<!-- Let content include its own layout classes like .login-container or .register-container -->
<?= isset($content) ? $content : '<p>Oops! No content loaded.</p>' ?>

<?php require_once COMPONENTS_PATH . '/footer.component.php'; ?>

<!-- Page-Specific JS -->
<?php if (isset($pageName)) : ?>
    <?php if ($pageName === 'about'): ?>
        <script src="/pages/aboutPage/assets/js/about.js" defer></script>
    <?php elseif ($pageName === 'home'): ?>
        <script src="/assets/js/scripts.js" defer></script>
    <?php elseif ($pageName === 'cart'): ?>
        <script src="/pages/cartPage/assets/js/cart.js" defer></script>
    <?php elseif ($pageName === 'login' || $pageName === 'register'): ?>
        <script src="/assets/js/scripts.js" defer></script>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>