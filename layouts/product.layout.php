<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | The Fourfold Path' : 'The Fourfold Path' ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caudex&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/pages/productPage/assets/css/product.css" rel="stylesheet">
</head>
<body class="product-page">

    <?php
    include COMPONENTS_PATH . '/navbar.component.php';
    include COMPONENTS_PATH . '/productHeader.component.php';
    ?>

    <div class="product-wrapper">
        <div class="container">
            <?= $content ?>
        </div>
    </div>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
    <script src="/pages/productPage/assets/js/product.js" defer></script>
</body>
</html>