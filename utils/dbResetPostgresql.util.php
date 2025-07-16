<?php
declare(strict_types=1);

require_once 'bootstrap.php';
require VENDOR_PATH . 'autoload.php';
require_once UTILS_PATH . 'envSetter.util.php';

echo "✅ Connecting to PostgreSQL...\n";

$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$dbName = $pdo->query("SELECT current_database()")->fetchColumn();
echo "🧭 Currently connected to database: {$dbName}\n";

echo "📦 Applying schema files...\n";
$schemaFiles = [
    'database/users.model.sql',
    'database/carts.model.sql',
    'database/cart.items.model.sql',
    'database/items.model.sql',
    'database/orders.model.sql'
];

foreach ($schemaFiles as $file) {
    echo "📄 Applying $file...\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("❌ Di ko mabasa file mo na $file");
    }
    $pdo->exec($sql);
}

echo "🔁 Truncating tables…\n";
$tables = ['cart_items', 'orders', 'items', 'carts', 'users'];
foreach ($tables as $table) {
    $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
}

echo "✅ Na-reset na ang mga tables successfully.\n";
