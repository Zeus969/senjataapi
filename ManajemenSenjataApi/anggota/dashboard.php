<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - SIM Senjata Api</title>
  <link rel="stylesheet" href="styles_dashboard.css">
</head>

<body>
  <div class="wrapper">

    <?php include 'sidebar.php'; ?>

    <main class="content">
      <header class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Selamat datang di Sistem Informasi Manajemen Senjata Api Kodim.</p>
      </header>

      <section class="info-boxes">
        <div class="info-box blue">🔫 <p>Input Peminjaman</p></div>
        <div class="info-box blue">📋 <p>Data Peminjaman</p></div>
        <div class="info-box orange">📄 <p>Data Anggota</p></div>
      </section>

      <section class="card">
        <h2>📌 Informasi Umum</h2>
        <p>Sistem ini bertujuan untuk membantu Kodim mengelola dan memantau transaksi data peminjaman senjata secara akurat, cepat, dan aman.</p>
      </section>
    </main>

  </div>
</body>
</html>
