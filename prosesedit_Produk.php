<?php
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $keterangan_produk = $_POST['keterangan_produk'];
    // Mengambil Nama Produk Yang Sebelumnya
    $stmt = $conn->prepare("SELECT gambar_produk FROM t_produk WHERE id_produk=?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    $gambar_produk = $data['gambar_produk'];
    // Mengecek apakah ada data gambar baru yang telah diupload
    if (isset($_FILES['gambar_produk']) && $_FILES['gambar_produk']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar_produk']['tmp_name'];
        $fileName = $_FILES['gambar_produk']['name'];
        $fileSize = $_FILES['gambar_produk']['size'];
        $fileType = $_FILES['gambar_produk']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        // Menentukan Jika Ada File Baru Yang Diedit Agar Unik 
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        // Nama folder yang digunakan untuk upload
        $uploadFileDir = 'uploads/';
        // Validasi data yang mempunyai ekstensi gambar
        $allowedfileExtension = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedfileExtension)) {
            $dest_path = $uploadFileDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Kalau proses upload berhasil maka dan update nama file gambar
                $gambar_produk = $newFileName;
                // Untuk meghapus file gambar lama pada server
                if (!empty($data['gambar_produk']) && file_exists($uploadFileDir . $data['gambar_produk'])) {
                    unlink($uploadFileDir . $data['gambar_produk']);
                }
            } else {
                echo "Gagal Proses Mengupload Gambar";
                exit();
            }
        } else {
            echo "Format File Tidak Sesuai";
            exit();
        }
    }
    // Bagian untuk mengupdata data produk
    $stmt = $conn->prepare("UPDATE t_produk SET nama_produk=?, harga_produk=?, keterangan_produk=?, gambar_produk=? WHERE id_produk=?");
    $stmt->bind_param("sissi", $nama_produk, $harga_produk, $keterangan_produk, $gambar_produk, $id_produk);

    if ($stmt->execute()) {
        echo "<script>alert('Data Produk Berhasi Di Perbarui'); window.location='dashboard_Admin.php';</script>";
    } else {
        echo "Gagal Mengupdate Data Produk" . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
