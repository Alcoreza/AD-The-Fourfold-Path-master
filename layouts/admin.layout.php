<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | The Fourfold Path' : 'The Fourfold Path' ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">

    <!-- Core + Admin Styles -->
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/pages/productPage/assets/css/product.css">
    <link rel="stylesheet" href="/pages/adminPage/assets/css/admin.css">
</head>

<body class="admin-page">

    <?php require_once COMPONENTS_PATH . '/adminNavbar.component.php'; ?>

    <main class="admin-container">
        <?= isset($content) ? $content : '<p>No admin content loaded.</p>' ?>
    </main>

    <?php require_once COMPONENTS_PATH . '/footer.component.php'; ?>
    <script src="/pages/adminPage/assets/js/admin.js" defer></script>
</body>
</html>