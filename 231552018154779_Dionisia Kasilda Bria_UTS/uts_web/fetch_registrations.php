<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    echo ''; exit;
}
$stmt = $pdo->prepare("SELECT nim, nama_mk, registered_at FROM registrations ORDER BY registered_at DESC");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $r) {
    $nim = htmlspecialchars($r['nim']);
    $mk = htmlspecialchars($r['nama_mk']);
    $t = htmlspecialchars($r['registered_at']);
    echo "<tr><td>$nim</td><td>$mk</td><td>$t</td></tr>";
}
