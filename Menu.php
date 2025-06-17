<?php
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT id_produk, nama_produk, keterangan_produk, harga_produk, gambar_produk FROM t_produk ORDER BY id_produk DESC";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare statement gagal: " . $conn->error);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Customer</title>
    <link rel="stylesheet" href="wedangstyle.css">
    <style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
.navbar {
  position: sticky;
  top: 0;
  z-index: 1000;
}
body {
  font-family: 'Poppins', sans-serif;
  background-image: url('Gambar/Background.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  color: white;
  position: relative;
  overflow: hidden;
}
body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: inherit;
  background-size: cover;
  background-position: center;
  filter: blur(4px);
  z-index: -2; 
}
body::after {
  content: "";
  position: fixed; 
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(5px); 
  background-color: rgba(0, 0, 0, 0.4); 
  z-index: -1; 
}
.menu-item {
  transition: transform 0.3s ease, box-shadow 0.3s ease;    
  cursor: pointer;
}
.menu-item:hover {
  transform: scale(1.05); 
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); 
  z-index: 10; 
}
.menu-item:active {
  transform: scale(0.98); 
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}
.logo {
  display: flex;
  align-items: center;
  gap: 10px;
}
.logo img {
  width: 100px;
  height: 100px;
}
.logo h1 {
  font-size: 24px;
  line-height: 1.2;
}
.menu a {
  margin-left: 15px;
  text-decoration: none;
  color: white;
  font-weight: 600;
}
.menu a.active {
  border-bottom: 2px solid white;
}
.produk {
  display: flex;
  justify-content: center;
  margin-top: 55px;
  width: 100%;
}
.core {
  display: flex;
  justify-content: center;
  width: 100%;
}
.produkk {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
  max-width: 1300px;
  padding: 20px;
}
.menu-item {
  background-color: rgba(0.0.0.0,5.0,9);
  width: 300px;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  margin-bottom: 200px;
}
.menu-item img {
  width: 260px;
  height: 260px;
  object-fit: cover;
  margin: 0 auto 15px auto;
  border-radius: 10px;
}
.menu-item hr {
  border-top: 1.5px solid rgba(255, 255, 255, 0.685);
  margin: 20px 0;
  width: 100%;
}
.menu-item p {
  font-size: 16px;
  font-weight: 400;
  margin-top: 10px;
  min-height: 70px;
}

.hargadantombol {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
  gap: 50px;
}
.harga {
  font-size: 18px;
  font-weight: bold;
  color: #ffffff;
}
.tombolorder {
  background-color: #543A14;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  width: 100px; /* Pastikan tidak fixed width */
  max-width: 100px; /* Optional */
}
.tombolorder:hover {
  background-color: rgba(167, 167, 167, 0.28);
}
@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
  }
  .menu {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
  }
  .menu-item {
    width: 90%;
  }
}
    </style>
</head>
<nav class="navbar">
        <div class="logo">
            <img src="Gambar/logowedangronde.png" alt="gambar logo">
            <h1>Wedang <br> Ronde</h1>
        </div>
        <div class="menu">
            <a href="Beranda.php">Beranda</a>
            <a href="Menu.php" class="active">Menu</a>
            <a href="Sejarah.php">Sejarah</a>
            <a href="Galeri.php">Galeri</a>
            <a href="Keranjang.php">Keranjang</a>
            <a href="Profil.php">Profil</a>
        </div>
    </nav>
    <div class="produk">
        <div class="core">
            <div class="produkk">
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="menu-item">
                        <img src="Gambar_Produk/<?= htmlspecialchars($row['gambar_produk']) ?>" alt="Produk">
                        <hr>
                        <h2><?= htmlspecialchars($row['nama_produk']) ?></h2>
                        <p><?= nl2br(htmlspecialchars($row['keterangan_produk'])) ?></p>
                        <div class="hargadantombol">
                            <span class="harga">Rp. <?= number_format($row['harga_produk'], 0, ',', '.') ?></span>
                            <form method="POST" action="tambah_Keranjang.php">
    <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
    <input type="hidden" name="nama_produk" value="<?= htmlspecialchars($row['nama_produk']) ?>">
    <input type="hidden" name="harga_produk" value="<?= $row['harga_produk'] ?>">
    <input type="hidden" name="gambar_produk" value="<?= htmlspecialchars($row['gambar_produk']) ?>">
    <button type="submit" class="tombolorder">Order</button>
</form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php $conn->close(); ?>
</body>
</html>