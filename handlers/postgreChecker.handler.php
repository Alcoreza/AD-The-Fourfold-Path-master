<?php
require_once UTILS_PATH . 'envSetter.util.php';

$host = $typeConfig['pgHost'];
$port = $typeConfig['pgPort'];
$username = $typeConfig['pgUser'];
$password = $typeConfig['pgPass'];
$dbname = $typeConfig['pgDb'];

if (!$host || !$port || !$dbname || !$username || !$password) {
    echo "❌ Missing PostgreSQL environment variables.<br>";
    exit();
}

$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";
$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "❌ Connection Failed: Unable to connect to PostgreSQL.<br>";
    exit();
} else {
    echo "✅ PostgreSQL Connection<br>";
    pg_close($dbconn);
}