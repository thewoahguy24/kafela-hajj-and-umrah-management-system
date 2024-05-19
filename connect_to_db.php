<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'kafela_hajj_and_omrah_db1';

// DSN (data source name)
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;

// PDO (PHP data object) SETUP
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection Faild ' . $e->getMessage());
}
