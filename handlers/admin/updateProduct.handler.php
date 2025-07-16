<?php
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/adminPage/index.php");
    exit;
}

$id = (int) ($_POST['item_id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$price = (float) ($_POST['price'] ?? 0);
$image = trim($_POST['image_url'] ?? '');
$desc = trim($_POST['description'] ?? '');

if (!$id || !$name || $price <= 0) {
    header("Location: /pages/adminPage/index.php");
    exit;
}

$conn = pg_connect(sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $pgConfig['host'],
    $pgConfig['port'],
    $pgConfig['db'],
    $pgConfig['user'],
    $pgConfig['pass']
));

if (!$conn) {
    die("Database connection failed");
}

if ($image) {
    pg_query_params(
        $conn,
        "UPDATE items SET name = $1, price = $2, image_url = $3, description = $4 WHERE item_id = $5",
        [$name, $price, $image, $desc, $id]
    );
} else {
    pg_query_params(
        $conn,
        "UPDATE items SET name = $1, price = $2, description = $3 WHERE item_id = $4",
        [$name, $price, $desc, $id]
    );
}

pg_close($conn);
header("Location: /pages/adminPage/index.php");
exit;
