<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    echo '<div class="alert alert-danger">Anda harus login.</div>'; exit;
}
$nim = trim($_POST['nim'] ?? '');
$nama_mk = trim($_POST['nama_mk'] ?? '');
$user_id = $_SESSION['user_id'];

if (!$nim || !$nama_mk) {
    echo '<div class="alert alert-danger">Semua field wajib diisi.</div>'; exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO registrations (user_id, nim, nama_mk) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $nim, $nama_mk]);

    // Return success message (replaces the form) AND return a small HTMX fragment for the new row
    // Strategy: HTMX dapat melakukan 2 permintaan: kita akan mengembalikan pesan sukses AND include sebuah
    // fragmen dengan hx-trigger client-side untuk append. Simpler: return both message and a <tr> with hx-swap-oob
    $lastId = $pdo->lastInsertId();

    // Ambil data inserted untuk membuat baris
    $stmt = $pdo->prepare("SELECT nim, nama_mk, registered_at FROM registrations WHERE id = ?");
    $stmt->execute([$lastId]);
    $row = $stmt->fetch();

    $nim_html = htmlspecialchars($row['nim']);
    $mk_html = htmlspecialchars($row['nama_mk']);
    $time_html = htmlspecialchars($row['registered_at']);

    // Response: pesan sukses untuk menukar form area, dan sebuah out-of-band swap untuk menambahkan baris ke tabel
    echo '<div class="alert alert-success">Pendaftaran berhasil!</div>';
    // Out-of-band swap: hx-swap-oob target ditujukan ke tbody (append)
    // menambahkan baris baru ke akhir tabel
    echo "<tr hx-swap-oob='afterbegin:#registrationsTable tbody'>
            <td>{$nim_html}</td>
            <td>{$mk_html}</td>
            <td>{$time_html}</td>
          </tr>";
} catch (Exception $e) {
    echo '<div class="alert alert-danger">Gagal menyimpan pendaftaran.</div>';
}
