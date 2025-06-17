<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_customer'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location.href='Login.php';</script>";
    exit();
}

// Koneksi database
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $targetDir = "Gambar/";
        $fileName = basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowTypes = array('jpg','jpeg','png','gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
                $id_customer = $_SESSION['id_customer'];
                $tanggal = date("Y-m-d");
                $jam = date("H:i:s");

                $stmt = $conn->prepare("INSERT INTO t_galeri (nama_galeri, tanggal_upload, jam_upload, id_customer) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $fileName, $tanggal, $jam, $id_customer);

                if ($stmt->execute()) {
                    header("Location: Galeri.php?upload=success");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo "Gagal memindahkan file.";
            }
        } else {
            echo "Format file tidak didukung.";
        }
    } else {
        echo "File gambar tidak ditemukan atau error.";
    }
}

$conn->close();
?>
