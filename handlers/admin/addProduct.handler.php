<?php
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/adminPage/index.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$price = (float) ($_POST['price'] ?? 0);
$stock_quantity = (int) ($_POST['stock_quantity'] ?? 0);
$image = trim($_POST['image_url'] ?? '');
$desc = trim($_POST['description'] ?? '');

if (!$name || $price <= 0 || $stock_quantity < 0) {
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

pg_query_params(
    $conn,
    "INSERT INTO items (name, price, stock_quantity, image_url, description)
     VALUES ($1, $2, $3, $4, $5)",
    [$name, $price, $stock_quantity, $image, $desc]
);

pg_close($conn);
header("Location: /pages/adminPage/index.php");
exit;
