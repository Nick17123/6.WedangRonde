<?php
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama_produk = $_POST['nama_produk'];
$harga_produk = $_POST['harga_produk'];
$gambar = $_FILES['gambar_produk']['name'];
$tmp = $_FILES['gambar_produk']['tmp_name'];
$keterangan_produk = $_POST['keterangan_produk'];
$path = "Gambar_Produk/" . basename($gambar);
move_uploaded_file($tmp, $path);

$stmt = $conn->prepare("INSERT INTO t_produk (nama_produk, harga_produk, keterangan_produk, gambar_produk) VALUES (?, ?, ?,?)");
$stmt->bind_param("siss", $nama_produk, $harga_produk, $keterangan_produk, $gambar);
$stmt->execute();
$stmt->close();

header("Location: dashboard_Admin.php?status=success");
exit;
?>
