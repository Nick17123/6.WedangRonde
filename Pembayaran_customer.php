
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
$stmt->close();
if (!$data) {
    die("Data Profik Tiak Ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="wedangstyle.css"/>
  <title>Dibuat</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      font-family: 'Poppins', sans-serif;
      height: 100%;
    }

    /* .hero {
      position: relative;
      background-image: url('Gambar/background.jpg'); 
      background-size: cover;
      background-position: center;
      height: 100vh;
      color: white;
    }

    .hero .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(5px);
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    } */
     .container {
      max-width: 600px;
      position: relative;
      z-index: 2;
      margin: 40px auto;
      background:rgba(255, 255, 255, 0.11);
      border: 2px solidrgb(246, 246, 246);
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    .title {
      text-align: center;
      color:rgb(255, 255, 255);
      margin-bottom: 24px;
    }

    .sub-navbar {
      position: relative;
      z-index: 2;
      text-align: center;
      margin-top: 10px;
    }

    .sub-menu {
      display: flex;
      justify-content: center;
      gap: 120px;
      position: relative;
    }

    .sub-menu a {
      color: white;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      padding-bottom: 5px;
    }

    .sub-menu a.sub-active::after {
      content: '';
      display: block;
      margin: 5px auto 0;
      width: 100%;
      border-bottom: 2px solid white;
    }

    .sub-divider {
      margin: 5px auto 0;
      width: 70%;
      height: 2px;
      background-color: white;
      opacity: 0.5;
    }

    .section {
      margin-bottom: 28px;
    }

    h2 {
      color:rgb(255, 255, 255);
      border-bottom: 2px solidrgb(255, 255, 255);
      padding-bottom: 6px;
      margin-bottom: 12px;
    }

    .info p {
      margin: 6px 0;
      color: #;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th, table td {
      border-bottom: 1px solid #eee;
      padding: 10px;
      text-align: left;
    }

    tfoot td {
      font-weight: bold;
      color:rgb(255, 255, 255);
    }

    select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 2px solidrgb(255, 255, 255);
      border-radius: 8px;
      background-color:rgb(255, 255, 255);
    }

    .btn {
      width: 100%;
      padding: 14px;
      font-size: 16px;
      background-color: #5c3a0c;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #7b5013;
    }


    .btn-wrapper {
      text-align: right;
      margin-top: 10px;
    }

    
  </style>
</head>
<body>
  <div class="hero">
    <div class="overlay"></div>
    <header class="navbar">
      <div class="logo">
        <img src="Gambar/logowedangronde.png" alt="Logo Wedang Ronde">
        <h1>Wedang <br> Ronde</h1>
      </div>
      <nav class="menu">
        <a href="Beranda.php">Beranda</a>
        <a href="Menu.php">Menu</a>
        <a href="Sejarah.php">Sejarah</a>
        <a href="Galeri.php">Galeri</a>
        <a href="Keranjang.php" class="active">Keranjang</a>
        <a href="Profil.php">Profil</a>
      </nav>
    </header>

    <div class="sub-navbar">
      <div class="sub-menu">
        <a href="Pembayaran.php" class="sub-active">Pembayaran</a>
        <a href="Dibuat.php">Dibuat</a>
        <a href="Dikirim.php">Dikirim</a>
        <a href="Selesai.php">Selesai</a>
      </div>
      <div class="sub-divider"></div>
    </div>

    <!-- Tab Dikirim -->
<div class="container">
    <h1 class="title">Checkout</h1>
    <div class="section">
      <h2>Informasi Pemesan</h2>
      <div class="info">
        <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama_customer']) ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($data['nohp_customer']) ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat_customer']) ?></p>
      </div>
    </div>

    <div class="section">
      <h2>Ringkasan Pesanan</h2>
      <table>
        <thead>
          <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Wedang Ronde Original</td>
            <td>2</td>
            <td>Rp20.000</td>
          </tr>
          <tr>
            <td>Ronde Cokelat</td>
            <td>1</td>
            <td>Rp12.000</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><strong>Total Bayar</strong></td>
            <td><strong>Rp32.000</strong></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="section">
      <h2>Metode Pembayaran</h2>
      <select>
        <option>Transfer</option>
        <option>COD (Bayar di Tempat)</option>
      </select>
    </div>
    <button class="btn">Bayar Sekarang</button>
  </div>
</body>
</html>