<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$id_customer = $_SESSION['id_customer'] ?? null;

if (!$id_customer) {
    die("ID customer tidak ditemukan. Harap login terlebih dahulu.");
}

$query = "SELECT * FROM t_customer WHERE id_customer = $id_customer";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);

$nama = $data['nama_customer'];
$alamat = $data['alamat_customer'];
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
?>

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran</title>
    <!-- <link rel="stylesheet" href="wedangstyle.css"> -->
  <style>
   
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      font-family: 'Poppins', sans-serif;
      height: 100%;
      background-color: #1a1a1a;
      
    }

    .hero {
      position: relative;
      background-image: url('Gambar/background.jpg'); 
      background-size: cover;
      background-position: center;
      height: 100vh;
      color: white;
      overflow: hidden;
      background-attachment: fixed;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(5px);
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .navbar {
      position: relative;
      z-index: 2;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
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
      font-size: 1.6rem;
      line-height: 1.8rem;
      font-weight: bold;
    }

    .menu a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
      font-size:1.6rem;
      margin-right: 35px;
    }

    .menu a:hover,
    .menu a.active {
      border-bottom: 2px solid white;
    }

    .status-pesanan {
      position: absolute;
      top: 120px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      display: flex;
      justify-content: space-around;
      align-items: center;
      width: 80%;
      max-width: 800px;
      padding-bottom: 10px;
      border-bottom: 3px solid rgb(255, 255, 255);
      gap: 80px;
    }

    .tahapan {
      font-size: 16px;
      font-weight: bold;
      color: #ffffff;
      position: relative;
      padding-bottom: 10px;
    }

    .tahapan.aktif::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: ;
    }
    /* //========================== */
    .konten-pembayaran {
  position: absolute;
  top: 200px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;
  width: 80%;
  max-width: 800px;
  color: white;
}

.judul-pembayaran {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.produk-pembayaran {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.gambar-produk {
  width: 120px;
  height: 120px;
  border-radius: 10%;
  margin-right: 10px;
  margin-left: -10px; /* Geser ke kiri */
}
.detail-produk h3 {
  margin: 0;
  font-size: 20px;
}

.detail-produk p {
  margin: 5px 0;
}

.total-produk {
  margin-left: auto;
  font-weight: bold;
  font-size: 20px;
  padding-top:-30px;
}

.info-tambahan {
  border-top: 2px solid white;
  padding-top: 15px;
}
/* ============================================= */
.info-tambahan p {
  margin: 10px 0;
}
.info-tambahan {
  border-top: 2px solid white;
  padding-top: 15px;
}

.baris-info {
  display: grid;
  grid-template-columns: 150px 10px 1fr;
  gap: 10px;
  color: white;
  margin: 10px 0;
  font-size: 18px;
}


.label-info {
  font-weight: normal;
}

.titik-dua {
  text-align: center;
}


  

/* =========================Form Kotak Input============================ */
.isi-info {
  font-weight: bold;
  font-size: 16px;
  padding: 8px;
  border-radius: 5px;
  border: none;
  outline: none;
  font-family: 'Poppins', sans-serif;
}

.isi-info::placeholder {
  color: #ccc;
}
.input-pesan {
  font-size: 16px;
  padding: 6px;
  border-radius: 5px;
  border: none;
  outline: none;
  width: 100%; /* agar mengikuti kolom grid auto */
  max-width: 620px; /* kamu bisa atur sesukamu */
  font-weight: normal;
  font-family: 'Poppins', sans-serif;
  margin-top:-5px;
  resize: none;
}
/* ========================================================= */
.tombol-pilih {
  background-color: #5a3b06; /* Coklat gelap */
  color: white;
  padding: 10px 30px;
  font-weight: bold;
  border: none;
  border-radius: 7px;
  font-family: 'Poppins', sans-serif;
  cursor: pointer;
  transition: background-color 0.3s;
}

.tombol-pilih:hover {
  background-color: #7b5010; /* Hover lebih terang */
}
/* ============================================================== */
.pilih-metode {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between; /* ganti dari gap: 10px */
  gap: 10px;
}


.input-metode {
  flex: 1;
  padding: 10px;
  border-radius: 10px;
  border: none;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  background-color: #ddd;
  color: #000;
}

.dropdown-metode {
  position: absolute;
  top: 45px;
  left: 0;
  background-color: #fff;
  color: #000;
  border-radius: 8px;
  overflow: hidden;
  display: none;
  box-shadow: 0 4px 8px rgba(0,0,0,0.3);
  z-index: 99;
  width: 100%;
}

.dropdown-metode div {
  padding: 10px;
  cursor: pointer;
  font-family: 'Poppins', sans-serif;
}

.dropdown-metode div:hover {
  background-color: #eee;
}
.garis-bawah {
  border: none;
  height: 2px;
  background-color: white;
  margin: 20px 0;
  opacity: 0.6;
}
.line {
    border: none;
    height: 2px;
    background-color: white;
    margin-top:10px;
    opacity: 0.6;
    width: 800px;
}
/* Kotak Hitam Tranparant */
.kotak-info-pembeli {
  background-color: rgba(0, 0, 0, 0.5); /* transparan */
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
  margin-top: 20px;
}
/* Rincian Pembayaran */
.rincian-pembayaran {
  background-color: rgba(0, 0, 0, 0.6); /* kotak hitam transparan */
  border-radius: 10px;
  padding: 20px;
  margin-top: 30px;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

.rincian-pembayaran h3 {
  margin-bottom: 15px;
  font-size: 20px;
  color: #f0cccc;
}

.baris-rincian {
  display: flex;
  justify-content: space-between;
  margin: 5px 0;
  font-size: 16px;
}

.baris-rincian.total {
  font-weight: bold;
  margin-top: 10px;
}

.garis-rincian {
  border: none;
  height: 1px;
  background-color: #fff;
  opacity: 0.6;
  margin: 15px 0;
}
/* Tombol bayar */
.tombol-bayar-wrapper {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
  margin-right: 10px; 
}
.tombol-bayar {
  background-color: #5a3b06;
  color: white;
  padding: 12px 30px;
  font-size: 16px;
  font-weight: bold;
  border: none;
  border-radius: 7px;
  font-family: 'Poppins', sans-serif;
  cursor: pointer;
  transition: background-color 0.3s;
}

.tombol-bayar:hover {
  background-color: #7b5010;
}
/* Scroll */
.scroll-container {
  height: calc(90vh - 10vh); /* Atur tinggi scroll sesuai kebutuhanmu */
  overflow-y: auto;
  position: relative;
  z-index: 2;
  width: 100%;
  margin-top:22px;
}

.konten-pembayaran {
  padding: -10px;
  width: 80%;
  max-width: 800px;
  margin: 0 auto;
  color: white;
  margin-top: -157px;
}
.detail-produk {
  margin-left: 25px; /* Tambahkan ini untuk menggeser tulisan ke kanan */
}


  </style>
</head>
<body>
<div class="container">
  <div class="hero">
    <div class="overlay"></div>

    <header class="navbar">
      <div class="logo">
        <img src="Gambar/logowedangronde.png" alt="Logo Wedang Ronde" />
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

    <!-- ✅ STATUS DILETAKKAN DI ATAS, DI TENGAH, DAN TIDAK NGE-BLUR -->
    <div class="status-pesanan">
      <div class="tahapan akti">Pembayaran</div>
      <div class="tahapan">Dibuat</div>
      <div class="tahapan">Dikirim</div>
      <div class="tahapan">Selesai</div>
    </div>
    <!-- Konten Pembayaran -->
<div class="scroll-container">
<div class="konten-pembayaran">
  <h2 class="judul-pembayaran">Pembayaran</h2>

  <?php if (!empty($keranjang)) : ?>
  <?php
    $total_item = 0;
    $total_harga = 0;
    foreach ($keranjang as $id_produk => $jumlah_data) :
      // Periksa apakah jumlah disimpan sebagai array atau angka langsung
      if (is_array($jumlah_data)) {
          $jumlah = $jumlah_data['jumlah'];
      } else {
          $jumlah = $jumlah_data;
      }

      $query = "SELECT * FROM t_produk WHERE id_produk = $id_produk";
      $result = mysqli_query($koneksi, $query);
      $produk = mysqli_fetch_assoc($result);

      $nama_produk = $produk['nama_produk'];
      $harga_produk = (int)$produk['harga_produk'];
      $gambar_produk = $produk['gambar_produk'];
      $subtotal = $harga_produk * (int)$jumlah;
      $total_item += $jumlah;
      $total_harga += $subtotal;
  ?>
    <!-- HTML untuk menampilkan produk -->
    <tr>
      <div class="produk-pembayaran">
  <img src="Gambar_Produk/<?php echo $gambar_produk; ?>" class="gambar-produk">
  <div class="detail-produk">
    <h3 class="nama-produk"><?php echo $nama_produk; ?></h3>
  </div>
</div>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>

  <hr class="line">
  <div class="kotak-info-pembeli">
  <div class="baris-info">
    <label class="label-info">Nama</label>
    <span class="titik-dua">:</span>
    <div class="isi-info"><?= htmlspecialchars($nama); ?></div>
  </div>
  <div class="baris-info">
    <label class="label-info">Alamat</label>
    <span class="titik-dua">:</span>
    <div class="isi-info"><?= htmlspecialchars($alamat); ?></div>
  </div>
</div>
   <form action="ProsesBayar.php" method="POST">
  <hr class="garis-bawah">
  
  <div class="baris-info">
    <label class="label-info" for="pesan">Pesan untuk Penjual</label>
    <span class="titik-dua">:</span>
    <textarea id="pesan" name="pesan_penjual" class="input-pesan" rows="3" placeholder="Tulis pesan untuk penjual, misalnya permintaan khusus..."></textarea>
  </div>

  <div class="baris-info">
    <label class="label-info" for="metode">Metode Pembayaran</label>
    <span class="titik-dua">:</span>
    <div class="pilih-metode">
      <input type="text" id="metode" name="metode_pembayaran" class="input-metode" placeholder="Pilih metode..." readonly required>
      <button type="button" class="tombol-pilih" onclick="tampilkanPilihan()">Pilih</button>
      <div id="dropdownMetode" class="dropdown-metode">
        <div onclick="pilihMetode('Transfer Bank')">Transfer Bank</div>
        <div onclick="pilihMetode('QRIS')">QRIS</div>
        <div onclick="pilihMetode('COD')">Bayar di Tempat (COD)</div>
      </div>
    </div>
    <hr class="line">
  </div>
  <!-- Rincian Pembayaran -->
  <div class="rincian-pembayaran">
    <h3>Rincian Pembayaran</h3>
    <div class="baris-rincian">
      <span>Total Produk</span>
      <span><?= $total_item ?></span>
    </div>
    <hr class="garis-rincian">
    <div class="baris-rincian">
      <span>Total Pembayaran</span>
      <span>Rp. <?= number_format($total_harga, 0, ',', '.'); ?></span>
    </div>
  </div>
<input type="hidden" name="total_harga" value="<?= $total_harga ?>">
  <div class="tombol-bayar-wrapper">
    <button type="submit" name="bayar" class="tombol-bayar">Bayar</button>
  </div>
</form>
  <script>
  function tampilkanPilihan() {
    const dropdown = document.getElementById("dropdownMetode");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  }

  function pilihMetode(metode) {
    document.getElementById("metode").value = metode;
    document.getElementById("dropdownMetode").style.display = "none";
  }

  // Tutup dropdown jika klik di luar area
  document.addEventListener("click", function(event) {
    const dropdown = document.getElementById("dropdownMetode");
    const tombol = document.querySelector(".tombol-pilih");
    if (!dropdown.contains(event.target) && !tombol.contains(event.target)) {
      dropdown.style.display = "none";
    }
  });
</script>
</body>
</html>
