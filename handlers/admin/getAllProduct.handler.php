<?php
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

function getAllProducts(): array
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
    if (!$conn)
        return [];

    $result = pg_query($conn, "SELECT item_id, name, price, image_url, description FROM items WHERE isDELETED = FALSE");
    $products = [];
    while ($row = pg_fetch_assoc($result)) {
        // Infer element from image path (optional)
        $url = $row['image_url'] ?? '';
        $element = 'unknown';
        if (strpos($url, '/fire/') !== false) {
            $element = 'fire';
        } elseif (strpos($url, '/water/') !== false) {
            $element = 'water';
        } elseif (strpos($url, '/earth/') !== false) {
            $element = 'earth';
        } elseif (strpos($url, '/air/') !== false) {
            $element = 'air';
        }

        $row['element'] = $element;
        $products[] = $row;
    }
    pg_close($conn);
    return $products;
}
