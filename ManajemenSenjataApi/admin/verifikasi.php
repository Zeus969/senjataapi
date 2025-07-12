<?php
include '../db.php';
session_start();

// Verifikasi login admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Jika ada aksi verifikasi
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $aksi = $_GET['aksi'] === 'setujui' ? 'Disetujui' : 'Ditolak';

    $stmt = $conn->prepare("UPDATE tabel_peminjaman SET status=? WHERE id_pinjam=?");
    $stmt->bind_param("si", $aksi, $id);
    $stmt->execute();
    $stmt->close();
}

// Ambil data peminjaman yang menunggu verifikasi
$result = $conn->query("SELECT p.id_pinjam, u.nama, s.nama_senjata, p.tanggal_pinjam 
                        FROM tabel_peminjaman p
                        JOIN tabel_user u ON p.id_user = u.id_user
                        JOIN tabel_senjata s ON p.id_senjata = s.id_senjata
                        WHERE p.status = 'Menunggu'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Peminjaman</title>
</head>
<body>
    <h2>Daftar Permintaan Peminjaman Senjata</h2>
    <table border="1">
        <tr>
            <th>Nama Peminjam</th>
            <th>Senjata</th>
            <th>Tanggal Pinjam</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['nama_senjata'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td>
                <a href="verifikasi.php?aksi=setujui&id=<?= $row['id_pinjam'] ?>">✅ Setujui</a> |
                <a href="verifikasi.php?aksi=tolak&id=<?= $row['id_pinjam'] ?>">❌ Tolak</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
