<?php
include "../db.php";
$id = $_GET['id'];

$conn->query("DELETE FROM peminjaman WHERE id = $id");
header("Location: data.php");
exit();
?>
