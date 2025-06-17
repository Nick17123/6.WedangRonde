<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $nama_galeri = $_POST['nama_galeri'];
  $conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  }
  // Hapus file gambar dari folder
  $file_path = "Gambar/" . $nama_galeri;
  if (file_exists($file_path)) {
    unlink($file_path);
  }
  // Hapus dari database prepared stetmen
  $stmt = $conn->prepare("DELETE FROM t_galeri WHERE id_galeri = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  // Kembali ke tampilan gaeri admin
  header("Location: galeri_Admin.php"); 
  exit;
}
?>
