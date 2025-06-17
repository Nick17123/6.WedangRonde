<?php 
session_start();
if (!isset($_SESSION['id_customer'])) {
header("location: Login.php");
exit();
}
$conn= new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error){
    die("Koneksi gagal:".$conn->connect_error);
}
$id_customer=$_SESSION['id_customer'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $jk = $_POST['jeniskelamin'];
    $nohp = preg_replace('/[^0-9]/', '', $_POST['nomortelepon']);
    $alamat = trim($_POST['alamat']);
    $bio = trim($_POST['bio']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid!");
    }
    $update = $conn->prepare("UPDATE t_customer SET nama_customer=?, email=?, jk_customer=?, nohp_customer=?, alamat_customer=?, bio_customer=? WHERE id_customer=?");
    if ($update === false) {
        die("Prepare failed: " . $conn->error);
    }
    $update->bind_param("ssssssi", $nama, $email, $jk, $nohp, $alamat, $bio, $id_customer);
    $update->execute();
    $update->close();
    header("Location: Profil.php?sukses=1");
    exit();
}
$query ="SELECT * FROM t_customer WHERE id_customer=?";
$stmt =$conn->prepare($query);
if ($stmt===false) {
die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id_customer);
$stmt->execute();
$result= $stmt->get_result();
$data=$result->fetch_assoc();
$_SESSION['nama'] = $data['nama_customer'];
$_SESSION['alamat'] = $data['alamat_customer'];
$stmt->close();
if (!$data) {
    die("Data Profik Tiak Ditemukan");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Wedang Ronde</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" /> -->
    <link rel="stylesheet" href="wedangstyle.css?v=2" />
    <style>
        /* body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('Gambar/backgroundmu.jpg') no-repeat center center/cover;
            position: relative;
        } */
        /* .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.21);
            z-index: 1;
        } */
        .profil-container {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .form-profil {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            color: white;
            width: 800px;
        }
        .profil-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profil-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 10px;
        }
        .profil-header h2 {
            margin: 0;
            font-weight: 600;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 40px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background-color: rgba(255,255,255,0.8);
            color: #000;
            font-size: 16px;
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .form-footer button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            background-color: white;
            color: black;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }
        .form-footer button:hover {
            background-color: #f0f0f0;
        }
        .notifikasi-sukses {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 18px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 99;
        }
    </style>
</head>
<body>
<div class="hero"> 
    <div class="overlay"></div>
    <nav class="navbar">
        <div class="logo">
            <img src="Gambar/logowedangronde.png" alt="gambarlogo" />
            <h1>Wedang <br> Ronde</h1>
        </div>
        <ul class="menu">
            <a href="Beranda.php">Beranda</a>
            <a href="Menu.php">Menu</a>
            <a href="Sejarah.php">Sejarah</a>
            <a href="Galeri.php">Galeri</a>
            <a href="Keranjang.php">Keranjang</a>
            <a href="Profil.php" class="active">Profil</a>
        </ul>
    </nav>
<?php if (isset($_GET['sukses'])): ?>
    <div class="notifikasi-sukses">Perubahan berhasil disimpan!</div>
<?php endif; ?>

<div class="profil-container">
    <form action="Profil.php" method="post" class="form-profil">
        <div class="profil-header">
            <img src="Gambar/user.jpg" alt="Profil Icon">
            <h2><?= htmlspecialchars($data['nama_customer']) ?></h2>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Nama :</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_customer']) ?>" required />
            </div>

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" readonly />
            </div>

            <div class="form-group">
                <label>Jenis Kelamin :</label>
                <select name="jeniskelamin" required>
                    <option value="Laki-laki" <?= $data['jk_customer'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['jk_customer'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>No. Telp :</label>
                <input type="text" name="nomortelepon" value="<?= htmlspecialchars($data['nohp_customer']) ?>" />
            </div>

            <div class="form-group">
                <label>Alamat :</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat_customer']) ?>" />
            </div>

            <div class="form-group">
                <label>Bio :</label>
                <input type="text" name="bio" value="<?= htmlspecialchars($data['bio_customer'] ?? '') ?>" />
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" name="simpan">Simpan Perubahan</button>
            <button type="button" onclick="window.location='Index.php';">Ganti Akun</button>
        </div>
    </form>
</div>
</body>
</html>