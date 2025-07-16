<?php
require_once UTILS_PATH . 'envSetter.util.php';

function addToCart(int $userId, string $itemTitle, int $quantity): array
{
    global $pgConfig;

    $conn = pg_connect(sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'],
        $pgConfig['port'],
        $pgConfig['db'],
        $pgConfig['user'],
        $pgConfig['pass']
    ));

    if (!$conn) {
        return ['error' => 'Database connection failed'];
    }

    // Get or create user's cart
    $cartRes = pg_query_params($conn, "SELECT cart_id FROM carts WHERE user_id = $1", [$userId]);
    if (pg_num_rows($cartRes) === 0) {
        $newCartRes = pg_query_params($conn, "INSERT INTO carts (user_id) VALUES ($1) RETURNING cart_id", [$userId]);
        $cartRow = pg_fetch_assoc($newCartRes);
    } else {
        $cartRow = pg_fetch_assoc($cartRes);
    }
    $cartId = $cartRow['cart_id'];

    // Get item_id
    $itemRes = pg_query_params($conn, "SELECT item_id FROM items WHERE LOWER(name) = LOWER($1)", [$itemTitle]);    if (pg_num_rows($itemRes) === 0) {
        return ['error' => 'Item not found'];
    }
    $itemRow = pg_fetch_assoc($itemRes);
    $itemId = $itemRow['item_id'];

    // Check if already in cart
    $checkRes = pg_query_params($conn,
        "SELECT quantity FROM cart_items WHERE cart_id = $1 AND item_id = $2",
        [$cartId, $itemId]
    );

    if (pg_num_rows($checkRes) > 0) {
        pg_query_params($conn,
            "UPDATE cart_items SET quantity = quantity + $1 WHERE cart_id = $2 AND item_id = $3",
            [$quantity, $cartId, $itemId]
        );
    } else {
        pg_query_params($conn,
            "INSERT INTO cart_items (cart_id, item_id, quantity) VALUES ($1, $2, $3)",
            [$cartId, $itemId, $quantity]
        );
    }

    pg_close($conn);
    return ['success' => 'Item added to cart'];
}
