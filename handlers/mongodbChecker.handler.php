<?php
require_once UTILS_PATH . 'envSetter.util.php';

$mongoUri = $typeConfig['mongoUri'];
$mongoDb  = $typeConfig['mongoDb'];

if (!$mongoUri || !$mongoDb) {
    echo "❌ Missing MongoDB environment variables.<br>";
    exit;
}

try {
    $mongo = new MongoDB\Driver\Manager($mongoUri);
    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand($mongoDb, $command);

    echo "✅ Connected to MongoDB successfully.<br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . htmlspecialchars($e->getMessage()) . "<br>";
}