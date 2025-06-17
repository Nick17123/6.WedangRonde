<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "db_wedang_ronde");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Tangkap data dari form
$nama = $_POST['nama_customer'];
$alamat = $_POST['alamat_customer'];
$no_hp = $_POST['nohp_customer'];
$jenis_kelamin = $_POST['jk_customer'];
$email = $_POST['email'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi konfirmasi password
if ($password !== $konfirmasi_password) {
    echo "<script>alert('Konfirmasi password tidak sesuai!'); window.location.href='Daftar.php';</script>";
    exit();
}

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Query SQL disesuaikan dengan nama tabel dan kolommu
$query = "INSERT INTO t_customer (nama_customer, alamat_customer, nohp_customer, jk_customer, email, password_customer) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($query);

// Cek jika prepare() gagal
if (!$stmt) {
    die("Prepare statement gagal: " . $koneksi->error);
}

// Binding parameter
$stmt->bind_param("ssssss", $nama, $alamat, $no_hp, $jenis_kelamin, $email, $password_hash);

// Eksekusi query
if ($stmt->execute()) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='Index.php';</script>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>
