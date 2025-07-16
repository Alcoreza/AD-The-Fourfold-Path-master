<?php
declare(strict_types=1);

require_once 'bootstrap.php';
require VENDOR_PATH . 'autoload.php';
require_once UTILS_PATH . 'envSetter.util.php';

$users = require_once DUMMIES_PATH . 'user.staticData.php';
$items = require_once DUMMIES_PATH . 'items.staticData.php';

echo "✅ Nakaconnect na sa PostgreSql";
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

echo "Inaapply na ang mga file\n";
$schemaFiles = [
    'database/users.model.sql',
    'database/items.model.sql'
];

foreach ($schemaFiles as $file) {
    echo "📄 Applying $file...\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("❌ Could not read $file");
    }
    $pdo->exec($sql);
}

$stmtUsers = $pdo->prepare("
    INSERT INTO users (username, password, email, role, created_at)
    VALUES (:username, :password, :email, :role, :created_at)
");

$stmtItems = $pdo->prepare("
    INSERT INTO items (name, price, stock, stock_quantity, image_url, description)
    VALUES (:name, :price, :stock, :stock_quantity, :image_url, :description)
");

$allSeeded = true;

echo "🔁 Seeding Users\n";
try {
    foreach ($users as $user) {
        $stmtUsers->execute([
            ':username'   => $user['username'],
            ':password'   => password_hash($user['password'], PASSWORD_DEFAULT),
            ':email'      => $user['email'],
            ':role'       => $user['role'],
            ':created_at' => $user['created_at']
        ]);
    }
} catch (PDOException $e) {
    echo "❌ Error seeding users: " . $e->getMessage() . "\n";
    $allSeeded = false;
}

echo "🔁 Seeding Items\n";
try {
    foreach ($items as $item) {
        $stmtItems->execute([
            ':name'           => $item['name'],
            ':price'          => $item['price'],
            ':stock'          => $item['stock'],
            ':stock_quantity' => $item['stock_quantity'],
            ':image_url'      => $item['image_url'],
            ':description'    => $item['description'],
        ]);
    }
} catch (PDOException $e) {
    echo "❌ Error seeding items: " . $e->getMessage() . "\n";
    $allSeeded = false;
}

if ($allSeeded) {
    echo "✅ Tables have been populated!\n";
}
