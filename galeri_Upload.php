<?php
include 'Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = '../uploads/';
    $tanggal = date('Y-m-d');
    $jam = date('H:i:s');

    if (move_uploaded_file($tmp, $folder . $foto)) {
        $sql = "INSERT INTO t_galeri (foto_galeri, tanggal_galeri, jam_galeri)
                VALUES ('$foto', '$tanggal', '$jam')";
        mysqli_query($koneksi, $sql);
        echo "Foto berhasil diupload!";
    } else {
        echo "Upload gagal.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="foto" required>
    <button type="submit">Upload Foto</button>
</form>
