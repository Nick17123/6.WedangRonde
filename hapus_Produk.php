<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan ID tersedia di parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil nama file gambar terlebih dahulu
    $stmt = $conn->prepare("SELECT gambar_produk FROM t_produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    if ($gambar && file_exists("Gambar_Produk/$gambar")) {
        unlink("Gambar_Produk/$gambar"); // Hapus file gambar dari folder
    }

    // Hapus data dari database
    $deleteStmt = $conn->prepare("DELETE FROM t_produk WHERE id_produk = ?");
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();
    $deleteStmt->close();

    // Redirect kembali ke dashboard
    header("Location: dashboard_Admin.php");
    exit;
} else {
    echo "ID produk tidak ditemukan.";
}
?>
