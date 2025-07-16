<?php
require_once UTILS_PATH . 'envSetter.util.php';

function registerUser(string $username, string $email, string $password): array
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/\.[a-z]{2,}$/i', $email)) {
        return ['error' => 'Invalid email format.'];
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    global $pgConfig;
    if (!isset($pgConfig) || !is_array($pgConfig)) {
        return ['error' => 'PostgreSQL configuration is missing.'];
    }

    $connStr = sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'],
        $pgConfig['port'],
        $pgConfig['db'],
        $pgConfig['user'],
        $pgConfig['pass']
    );

    $conn = pg_connect($connStr);
    if (!$conn) {
        return ['error' => 'Database connection failed.'];
    }

    // Check if username or email already exists
    $existsResult = pg_query_params(
        $conn,
        "SELECT id FROM users WHERE username = $1 OR email = $2",
        [$username, $email]
    );

    if (pg_num_rows($existsResult) > 0) {
        pg_close($conn);
        return ['error' => 'Username or email already exists.'];
    }

    // Insert new user
    $insertResult = pg_query_params(
        $conn,
        "INSERT INTO users (username, password, email) VALUES ($1, $2, $3) RETURNING id",
        [$username, $passwordHash, $email]
    );

    if (!$insertResult || pg_num_rows($insertResult) !== 1) {
        pg_close($conn);
        return ['error' => 'Registration failed. Please try again.'];
    }

    $userId = pg_fetch_result($insertResult, 0, 'id');

    // Create cart for the new user
    $cartResult = pg_query_params(
        $conn,
        "INSERT INTO carts (user_id) VALUES ($1)",
        [$userId]
    );

    pg_close($conn);

    if (!$cartResult) {
        return ['error' => 'User created but cart initialization failed.'];
    }

    return ['success' => 'Registration successful! Redirecting to login...'];
}
