<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'addToCart.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    if (!isset($_SESSION['user']['id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'User not logged in']);
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $title = $_POST['title'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;

    $result = addToCart($userId, $title, (int)$quantity);
    echo json_encode($result);
    exit;
}
