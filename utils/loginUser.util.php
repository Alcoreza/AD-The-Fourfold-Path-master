<?php
require_once UTILS_PATH . 'envSetter.util.php';

function loginUser(string $usernameOrEmail, string $password): array
{
    global $pgConfig;

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

    // Query to find user by username OR email
    $result = pg_query_params(
        $conn,
        "SELECT id, username, password FROM users WHERE username = $1 OR email = $1",
        [$usernameOrEmail]
    );

    if (!$result || pg_num_rows($result) === 0) {
        pg_close($conn);
        return ['error' => 'Invalid username/email or password.'];
    }

    $user = pg_fetch_assoc($result);

    if (!password_verify($password, $user['password'])) {
        pg_close($conn);
        return ['error' => 'Invalid credentials.'];
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username']
    ];

    pg_close($conn);
    return ['success' => 'Login successful!'];
}
