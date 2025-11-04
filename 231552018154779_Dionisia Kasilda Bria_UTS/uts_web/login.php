<?php
// login.php
require 'db.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    echo '<div class="alert alert-danger">Username & password dibutuhkan.</div>';
    exit;
}

$stmt = $pdo->prepare("SELECT id, password, nama_lengkap FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    echo '<div class="alert alert-danger">Login gagal: username atau password salah.</div>';
    exit;
}

// sukses -> set session
$_SESSION['user_id'] = $user['id'];
$_SESSION['nama_lengkap'] = $user['nama_lengkap'];

// Return small JS snippet that will redirect (HTMX will execute it).
// HTMX by default does not run returned <script> unless swapped into DOM; 
// but we can return script that sets window.location via hx-trigger=... However simplest:
echo '<script>window.location.href="dashboard.php";</script>';
