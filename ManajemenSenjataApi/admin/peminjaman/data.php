<?php
include "../db.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    
  <meta charset="UTF-8">
  <title>Data Peminjaman Senjata</title>
  <link rel="stylesheet" href="../styles_dashboard.css">
  <style>
    .table-container {
      padding: 30px;
      flex: 1;
      overflow-y: auto;
    }

    .input-button {
      margin-bottom: 15px;
    }

    .input-button a {
      padding: 8px 16px;
      background-color: #2ecc71;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
      border: 1px solid #ddd;
    }

    th {
      background-color: #2c3e50;
      color: white;
    }

    a.btn {
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      font-size: 14px;
    }

    .read { background-color: #3498db; }
    .update { background-color: #f39c12; }
    .delete { background-color: #e74c3c; }
    .btn:hover { opacity: 0.8; }
  </style>
</head>
<body>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="table-container">
    <h2>📋 Data Peminjaman Senjata</h2>
    <br></br>

    <div class="input-button">
      <a href="input.php">+ Tambah Peminjaman</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Peminjam</th>
          <th>Nama Senjata</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = $conn->query("SELECT * FROM peminjaman ORDER BY tanggal_pinjam DESC");
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>$no</td>
                  <td>{$row['nama_peminjam']}</td>
                  <td>{$row['nama_senjata']}</td>
                  <td>{$row['tanggal_pinjam']}</td>
                  <td>{$row['tanggal_kembali']}</td>
                  <td>{$row['status']}</td>
                  <td>
                    <a href='update.php?id={$row['id']}' class='btn update'>Update</a>
                    <a href='delete.php?id={$row['id']}' class='btn delete' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Delete</a>
                  </td>
                </tr>";
          $no++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>