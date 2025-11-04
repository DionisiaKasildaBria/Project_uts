<?php
// index.php
require 'db.php';
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pendaftaran Kelas Khusus - Login / Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-3">Masuk</h4>

            <!-- Login form (HTMX) -->
            <form id="loginForm" hx-post="login.php" hx-target="#loginResult" hx-swap="innerHTML">
              <div class="mb-2">
                <label class="form-label">Username</label>
                <input name="username" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button class="btn btn-primary">Login</button>
            </form>
            <div id="loginResult" class="mt-2"></div>

            <hr>

            <h5 class="mt-3">Belum punya akun? Daftar</h5>

            <!-- Registration form (HTMX) -->
            <form id="regForm" hx-post="register.php" hx-target="#regResult" hx-swap="innerHTML">
              <div class="mb-2">
                <label class="form-label">Username</label>
                <input name="username" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Nama Lengkap</label>
                <input name="nama_lengkap" class="form-control" required>
              </div>
              <button class="btn btn-success">Daftar</button>
            </form>
            <div id="regResult" class="mt-2"></div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
