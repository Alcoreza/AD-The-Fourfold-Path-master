<?php
declare(strict_types=1);

require_once 'bootstrap.php';
require VENDOR_PATH . 'autoload.php';
require_once UTILS_PATH . 'envSetter.util.php';

echo "🔌 Connecting to PostgreSQL...\n";
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

echo "🧹 Dropping existing tables if they exist...\n";
$tables = ['items', 'users', 'carts', 'carts_items', 'orders'];
foreach ($tables as $table) {
    $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
    echo "✅ Dropped table: {$table}\n";
}

echo "📦 Applying schema files...\n";
$schemaFiles = [
    'database/users.model.sql',
    'database/items.model.sql',
    'database/carts.model.sql',
    'database/cart.items.model.sql',
    'database/orders.model.sql'
];

foreach ($schemaFiles as $file) {
    echo "📄 Applying $file...\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("❌ Could not read $file");
    }
    $pdo->exec($sql);
    echo "✅ Applied schema from $file\n";
}

echo "✅ Migration complete. Database is ready.\n";
