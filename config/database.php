<?php
$dsn = 'mysql:host=localhost;dbname=madridkh;charset=utf8mb4';
$user = 'db_user';
$pass = 'db_pass';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
