<?php
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/adminPage/index.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$price = (float) ($_POST['price'] ?? 0);
$image = trim($_POST['image_url'] ?? '');
$quantity = (int) ($_POST['quantity'] ?? 0);
$desc = trim($_POST['description'] ?? '');

if (!$name || $price <= 0 || $quantity < 0) {
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
    "INSERT INTO items (name, price, image_url, stock_quantity, description) VALUES ($1, $2, $3, $4, $5)",
    [$name, $price, $image, $quantity, $desc]
);

pg_close($conn);
header("Location: /pages/adminPage/index.php");
exit;
