<?php
$dsn = 'mysql:host=localhost;dbname=madridkh;charset=utf8mb4';
$user = 'madriduser';
$pass = 'Mkr@9899';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
