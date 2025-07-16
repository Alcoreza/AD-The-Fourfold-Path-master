<?php
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

$itemId = (int) ($_GET['item_id'] ?? 0);

if ($itemId <= 0) {
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

$result = pg_query_params(
    $conn,
    "DELETE FROM items WHERE item_id = $1",
    [$itemId]
);

pg_close($conn);
header("Location: /pages/adminPage/index.php");
exit;
