<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>
<?php
// koneksi
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// ambil data produk
$stmt = $conn->prepare("SELECT id_produk, nama_produk, harga_produk, keterangan_produk FROM t_produk ORDER BY id_produk ASC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      height: 90%;
      width: 100%;
      background-color: #5b4220;
      font-family: 'Poppins', sans-serif;
    }
    .background {
      position: relative;
      height: 100vh;
      width: 100vw;
    }
  .header {
      position: absolute;
      top: 0;
      left: 0;
      height: 100px;
      width: 100%;
      background-color: #5b4220;
      display: flex;
      align-items: center;
      padding: 0 30px;
      z-index: 10;
    }
    .logo {
      height: 110px;
      width: 110px;
      margin-right: 15px;
    }
    .title {
      color: #fff;
      font-size: 22px;
      font-weight: bold;
    }
    .content-box {
      position: absolute;
      top: 100px;
      left: 240px;
      right: 0;
      bottom: 0;
      background-color: #f1e1ce;
    }
    .sidebar {
      position: absolute;
      top: 100px;
      left: 0;
      width: 240px;
      bottom: 0;
      background-color: #5b4220;
      padding-top: 30px;
    }
    .sidebar ul {
      list-style: none;
      padding-left: 30px;
    }
    .sidebar ul li {
      font-size: 16px;
      margin-bottom: 25px;
      cursor: pointer;
      font-weight: 500;
      position: relative;
    }
    .sidebar ul li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      display: inline-block;
      position: relative;
    }
    .sidebar ul li a.active {
      font-weight: bold;
    }
    .sidebar ul li a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  display: inline-block;
  position: relative;
}
.sidebar ul li a::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: -5px;
  width: 0;
  height: 4px;
  background-color: white;
  transition: width 0.3s ease-in-out;
}
.sidebar ul li a:hover::after {
  width: 100%;
}
.sidebar ul li a.active::after {
  width: 100%;
}
    .table-container {
      margin: 40px;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      overflow-x: auto;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }
      .content-box {
        left: 0;
        top: auto;
        margin-top: 20px;
      }
    }
    .form-container {
  margin: 30px;
  padding: 40px;
  background-color: white;
  border-radius: 12px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}
.form-container form {
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  justify-content: space-between;
}
.left-side,
.right-side {
  width: 48%;
  display: flex;
  flex-direction: column;
}
.left-side label,
.right-side label {
  font-weight: 600;
  margin-bottom: 5px;
}
.left-side input,
.right-side input[type="file"],
.left-side textarea {
  margin-bottom: 20px;
  padding: 10px;
  font-size: 14px;
  border: 2px solid #ccc;
  border-radius: 6px;
  background-color: #f5f3ef;
}
.image-preview {
  width: 52vh;
  height: 52vh;
  background-color: #f5f3ef;
  border-radius: 6px;
  margin-bottom: 15px;
}
.button-group {
  width: 100%;
  display: flex;
  justify-content: space-between;
  margin-top: 30px;
}
.button-group button {
  background-color: #5b4220;
  color: white;
  border: none;
  padding: 10px 24px;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
}
.button-group button:hover {
  opacity: 0.9;
}
  </style>
</head>
<body>
  <div class="background">
    <div class="header">
      <img src="Gambar/logowedangronde.png" alt="Logo Wedang Ronde" class="logo">
      <div class="title">WEDANG RONDE</div>
    </div>
    <div class="sidebar">
      <ul>
        <li><a href="dashboard_Admin.php" class="<?= ($currentPage == 'dashboard_Admin.php') ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="galeri_Admin.php" class="<?= ($currentPage == 'galeri_Admin.php') ? 'active' : '' ?>">Galeri</a></li>
        <li><a href="pesanan_Admin.php" class="<?= ($currentPage == 'pesanan_Admin.php') ? 'active' : '' ?>">Pesanan</a></li>
        <li><a href="datapelanggan_Admin.php" class="<?= ($currentPage == 'datapelanggan_Admin.php') ? 'active' : '' ?>">Data Pelanggan</a></li>
        <li><a href="riwayatpembelian_Admin.php" class="<?= ($currentPage == 'riwayatpembelian_Admin.php') ? 'active' : '' ?>">Riwayat Pembelian</a></li>
      </ul>
    </div>
    <div class="content-box">
        <div class="form-container">
  <form action="prosestambah_Produk.php" method="post" enctype="multipart/form-data">
    <div class="left-side">
      <label>ID Produk :</label>
      <input type="text" name="id_produk" required>
      <label>Nama Produk :</label>
      <input type="text" name="nama_produk" required>
      <label>Harga Produk :</label>
      <input type="number" name="harga_produk" required>
      <label>Keterangan Produk :</label>
      <input name="keterangan_produk" rows="5" required>
    </div>
    <div class="right-side">
      <label>Upload Gambar :</label>
      <div class="image-preview"></div>
      <input type="file" name="gambar_produk" accept="image/*" required>
    </div>
    <div class="button-group">
      <button type="button" onclick="window.history.back()">Kembali</button>
      <button type="submit">Publikasikan</button>
    </div>
  </form>
</div>
    </div>
  </div>
  <script>
  const inputGambar = document.querySelector('input[name="gambar_produk"]');
  const preview = document.querySelector('.image-preview');
  inputGambar.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.style.backgroundImage = `url('${e.target.result}')`;
        preview.style.backgroundSize = 'contain';
        preview.style.backgroundPosition = 'center';
      };
      reader.readAsDataURL(file);
    }
  });
</script>
</body>
</html>
