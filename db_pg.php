<?php
// User database.
// On Replit, DATABASE_URL points to Postgres.
// On your own computer (no DATABASE_URL), a local SQLite file users.db is used instead.

$dbUrl = getenv('DATABASE_URL');

try {
    if ($dbUrl) {
        $dbopts = parse_url($dbUrl);
        $host = $dbopts["host"];
        $port = $dbopts["port"] ?? 5432;
        $dbname = ltrim($dbopts["path"], '/');
        $user = $dbopts["user"];
        $pass = $dbopts["pass"];
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    } else {
        $pdo = new PDO("sqlite:" . __DIR__ . "/users.db");
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE,
            password TEXT
        )");
    }
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Error connecting to database: " . $e->getMessage();
    exit();
}
