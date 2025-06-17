<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    // Cek apakah user sudah login
    if (!isset($_SESSION['id_customer'])) {
        echo "<script>alert('Anda belum login.'); window.location.href='login.php';</script>";
        exit;
    }

    $id_customer = $_SESSION['id_customer'];
    $pesan_penjual = trim($_POST['pesan_penjual'] ?? '');
    $metode_pembayaran = trim($_POST['metode_pembayaran'] ?? '');

    if (empty($metode_pembayaran)) {
        echo "<script>alert('Metode pembayaran wajib dipilih.'); window.history.back();</script>";
        exit;
    }

    // Simpan ke tabel t_pesanan
    $stmt = $con->prepare("INSERT INTO t_pesanan (id_customer, total_harga, pesan_penjual, metode_pembayaran, tanggal_pesanan) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("idss", $id_customer, $total_harga, $pesan_penjual, $metode_pembayaran);
    $stmt->execute();

    $id_pesanan = $stmt->insert_id;

    echo "<script>alert('Pembayaran berhasil!'); window.location.href='beranda.php';</script>";
    exit;
}
?>
