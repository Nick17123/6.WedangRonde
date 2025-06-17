<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga_produk'];
    $gambar = $_POST['gambar_produk'];

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    // Jika produk sudah ada di keranjang, tambahkan jumlahnya
    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]['jumlah'] += 1;
    } else {
        // Tambahkan produk baru ke keranjang
        $_SESSION['keranjang'][$id] = [
            'nama' => $nama,
            'harga' => $harga,
            'gambar' => $gambar,
            'jumlah' => 1
        ];
    }
    // Redirect kembali ke menu atau ke keranjang
    header("Location: Keranjang.php");
    exit();
}
?>
