<?php
session_start();
require_once BOOTSTRAP_PATH;
require_once UTILS_PATH . 'register.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        $_SESSION['register_error'] = 'Passwords do not match.';
        header('Location: /pages/registerPage/index.php');
        exit;
    }

    $result = registerUser($username, $email, $password);

    if (isset($result['error'])) {
        $_SESSION['register_error'] = $result['error'];
    } elseif (isset($result['success'])) {
        $_SESSION['register_success'] = $result['success'];
    }

    header('Location: /pages/registerPage/index.php');
    exit;
}
