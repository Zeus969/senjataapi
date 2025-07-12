<?php
include "../db.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $senjata = $_POST['senjata'];
    $pinjam = $_POST['tanggal_pinjam'];
    $kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO peminjaman (nama_peminjam, nama_senjata, tanggal_pinjam, tanggal_kembali, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $senjata, $pinjam, $kembali, $status);
    $stmt->execute();

    echo "<script>alert('Data berhasil disimpan'); window.location.href='input.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Input Peminjaman Senjata</title>
  <link rel="stylesheet" href="../styles_dashboard.css">
  <style>
    .form-container {
      padding: 30px;
      flex: 1;
    }

    h2 {
      margin-bottom: 20px;
    }

    form {
      background-color: #ffffff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
      max-width: 500px;
    }

    form label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
      color: #333;
    }

    form input,
    form select {
      width: 100%;
      padding: 10px 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    form input:focus,
    form select:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
      outline: none;
    }

    form button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 15px;
      transition: background-color 0.3s ease;
    }

    form button:hover {
      background-color: #2980b9;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #2980b9;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    @media screen and (max-width: 768px) {
      .form-container {
        padding: 20px;
      }

      form {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="form-container">
    <h2>🔫 Form Peminjaman Senjata</h2>

    <form method="POST" action="">
      <label>Nama Peminjam:</label>
      <input type="text" name="nama" required>

      <label>Nama Senjata:</label>
      <input type="text" name="senjata" required>

      <label>Tanggal Pinjam:</label>
      <input type="date" name="tanggal_pinjam" required>

      <label>Tanggal Kembali:</label>
      <input type="date" name="tanggal_kembali">

      <label>Status:</label>
      <select name="status" require>
        <option value="Dipinjam">Dipinjam</option>
      </select>

      <button type="submit">Simpan</button>
    </form>

    <a class="back-link" href="../dashboard.php">⬅ Kembali ke Dashboard</a>
  </div>
</div>

</body>
</html>
