<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data customer berdasarkan ID
$stmt = $conn->prepare("SELECT nama_customer, alamat_customer, nohp_customer, jk_customer, email FROM t_customer WHERE id_customer = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = $result->fetch_assoc();
$stmt->close();

// Proses update ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_customer'];
    $alamat = $_POST['alamat_customer'];
    $nohp = $_POST['nohp_customer'];
    $jk = $_POST['jk_customer'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE t_customer SET nama_customer = ?, alamat_customer = ?, nohp_customer = ?, jk_customer = ?, email = ? WHERE id_customer = ?");
    $stmt->bind_param("sssssi", $nama, $alamat, $nohp, $jk, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='datapelanggan_Admin.php';</script>";
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1e1ce;
            padding: 40px;
        }
        form {
            background: white;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
        }
        input, select {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 8px;
        }
        button {
            margin-top: 15px;
            background-color: #5b4220;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Edit Data Pelanggan</h2>
        <label>Nama:</label>
        <input type="text" name="nama_customer" value="<?= htmlspecialchars($data['nama_customer']) ?>" required>

        <label>Alamat:</label>
        <input type="text" name="alamat_customer" value="<?= htmlspecialchars($data['alamat_customer']) ?>" required>

        <label>No HP:</label>
        <input type="text" name="nohp_customer" value="<?= htmlspecialchars($data['nohp_customer']) ?>" required>

        <label>Jenis Kelamin:</label>
        <select name="jk_customer" required>
            <option value="Laki-laki" <?= ($data['jk_customer'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= ($data['jk_customer'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>