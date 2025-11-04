<?php
// register.php
require 'db.php';

function jsonResponse($html) {
    echo $html;
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$nama = trim($_POST['nama_lengkap'] ?? '');

if (!$username || !$password || !$nama) {
    jsonResponse('<div class="alert alert-danger">Semua field wajib diisi.</div>');
}

try {
    // cek username unik
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        jsonResponse('<div class="alert alert-danger">Username sudah dipakai.</div>');
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, nama_lengkap) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hash, $nama]);

    jsonResponse('<div class="alert alert-success">Akun berhasil dibuat, silakan login.</div>');
} catch (Exception $e) {
    jsonResponse('<div class="alert alert-danger">Terjadi kesalahan. Coba lagi.</div>');
}
