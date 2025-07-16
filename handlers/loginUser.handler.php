<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'loginUser.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate fields before sending to util
    if (empty($usernameOrEmail) || empty($password)) {
        $_SESSION['login_error'] = 'Please fill in all fields.';
        header('Location: /pages/loginPage/index.php');
        exit;
    }

    $result = loginUser($usernameOrEmail, $password);

    if (isset($result['error'])) {
        $_SESSION['login_error'] = $result['error'];
        header('Location: /pages/loginPage/index.php');
        exit;
    }

    if (isset($result['success']) && isset($result['user'])) {
        $_SESSION['user'] = $result['user'];
        $_SESSION['user_id'] = $result['user']['id'];
        $_SESSION['login_success'] = $result['success'];

        header('Location: /index.php');
        exit;
    }

} else {
    // If someone tries to access directly
    header('Location: /pages/loginPage/index.php');
    exit;
}