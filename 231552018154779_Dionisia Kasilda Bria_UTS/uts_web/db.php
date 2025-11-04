<?php
error_reporting(0);
session_start();

$DB_HOST = 'localhost';
$DB_NAME = 'uts_web';
$DB_USER = 'root';
$DB_PASS = ''; // Kosong untuk Laragon

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Koneksi database gagal.");
}
