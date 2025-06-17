<?php
session_start();

// Periksa apakah ada data POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus produk dari session keranjang jika ada
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
    }
}

// Setelah dihapus, kembali ke halaman Keranjang
header("Location: Keranjang.php");
exit;
?>
