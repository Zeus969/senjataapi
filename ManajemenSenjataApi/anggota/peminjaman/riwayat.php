<?php
include "../db.php";
session_start();
 if (!isset($_SESSION['username'])) {
    header("Location: ../index.html");
    exit();
}

// Cek apakah file koneksi dan sidebar tersedia
if (!file_exists("../db.php") || !file_exists("sidebar.php")) {
    die("File koneksi atau sidebar tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Inventory Senjata</title>
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
    <h2>📦 Riwayat Inventory Senjata</h2>
    <br>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Senjata</th>
          <th>Jumlah</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = "
          SELECT ir.*, s.nama_senjata 
          FROM inventory_riwayat ir
          JOIN senjata s ON ir.senjata_id = s.id
          ORDER BY ir.tanggal DESC
        ";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $class = strtolower($row['jenis_transaksi']) === 'masuk' ? 'masuk' : 'keluar';
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_senjata']}</td>
                    <td>{$row['tanggal_kembali']}</td>
                    <td>{$row['keterangan']}</td>
                  </tr>";
            $no++;
          }
        } else {
          echo "<tr><td colspan='6'>Belum ada riwayat inventory senjata.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
