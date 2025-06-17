<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM t_customer WHERE id_customer = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect ke halaman sebelumnya setelah berhasil hapus
        header("Location: datapelanggan_Admin.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
    $stmt->close();
} else {
    echo "ID tidak valid.";
}
$conn->close();
?>
