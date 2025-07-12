<?php
include "../db.php";
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $senjata = $_POST['senjata'];
    $pinjam = $_POST['tanggal_pinjam'];
    $kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE peminjaman SET nama_peminjam=?, nama_senjata=?, tanggal_pinjam=?, tanggal_kembali=?, status=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama, $senjata, $pinjam, $kembali, $status, $id);
    $stmt->execute();

    echo "<script>alert('Data berhasil diupdate'); window.location.href='data.php';</script>";
    exit();
}

// Ambil data untuk diedit
$result = $conn->query("SELECT * FROM peminjaman WHERE id = $id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 30px;
        color: #333;
    }

    form {
        background-color: #fff;
        max-width: 500px;
        margin: 30px auto;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #444;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        background-color: #fefefe;
    }

    button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #218838;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
<h2>Edit Data Peminjaman</h2>
<form method="POST">
  <label>Nama Peminjam:</label><br>
  <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_peminjam']) ?>" required><br><br>

  <label>Nama Senjata:</label><br>
  <input type="text" name="senjata" value="<?= htmlspecialchars($data['nama_senjata']) ?>" required><br><br>

  <label>Tanggal Pinjam:</label><br>
  <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam'] ?>" required><br><br>

  <label>Tanggal Kembali:</label><br>
  <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>"><br><br>

  <label>Status:</label><br>
  <select name="status">
    <option value="Menunggu Verifikasi" <?= $data['status'] == 'Menunggu Verifikasi' ? 'selected' : '' ?>>Menunggu Verifikasi</option>
    <option value="Dipinjam" <?= $data['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
    <option value="Dikembalikan" <?= $data['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
  </select><br><br>

  <button type="submit">Simpan Perubahan</button>
</form>
<br>
<a href="data.php">⬅ Kembali ke Data</a>
</body>
</html>
