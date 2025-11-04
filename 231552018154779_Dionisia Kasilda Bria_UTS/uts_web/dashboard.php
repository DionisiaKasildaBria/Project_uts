<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); exit;
}
$nama = htmlspecialchars($_SESSION['nama_lengkap']);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - Pendaftaran Kelas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body class="bg-light">
  <nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
      <span class="navbar-brand mb-0 h1">Pendaftaran Kelas Khusus</span>
      <div>
        <span class="me-3">Selamat datang, <strong><?= $nama ?></strong></span>
        <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <div class="row">
      <div class="col-md-5">
        <div class="card mb-3">
          <div class="card-body">
            <h5>Form Pendaftaran Kelas</h5>

            <!-- form pendaftaran via HTMX -->
            <form hx-post="register_class.php" hx-target="#regClassResult" hx-swap="innerHTML">
              <div class="mb-2">
                <label class="form-label">NIM</label>
                <input name="nim" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Nama Mata Kuliah</label>
                <input name="nama_mk" class="form-control" required>
              </div>
              <button class="btn btn-primary">Daftar</button>
            </form>
            <div id="regClassResult" class="mt-2"></div>
          </div>
        </div>
      </div>

      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <h5>Daftar Pendaftar</h5>
            <table class="table table-striped" id="registrationsTable">
              <thead>
                <tr><th>NIM</th><th>Nama Mata Kuliah</th><th>Waktu</th></tr>
              </thead>
              <tbody hx-get="fetch_registrations.php" hx-trigger="load" hx-swap="innerHTML">
                <!-- data akan dimuat via fetch_registrations.php -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
