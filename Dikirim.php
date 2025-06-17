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

    .navbar {
      position: relative;
      z-index: 2;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0px 50px;
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
      position: relative;
    }

    .menu a:hover,
    .menu a.active {
      border-bottom: 2px solid white;
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

    /* Dibuat */

    .tab-content-wrapper {
      position: relative;
      z-index: 2;
      backdrop-filter: blur(5px);
      background-color: rgba(0, 0, 0, 0.4);
      padding: 20px;
      border-radius: 10px;
      width: 70%;
      margin: 30px auto 0;
    }

    .tab-content {
      backdrop-filter: none;
    }

    .pesanan-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 0px;
    }

    .pesanan-kiri {
      display: flex;
      align-items: center;
    }

    .produk-img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }

    .produk-detail {
      color: #ffffff;
    }

    .produk-nama {
      font-weight: bold;
      font-size: 18px;
    }

    .produk-jumlah {
      font-size: 14px;
      color: #ffffff;
      margin-top: 3px;
    }

    .pesanan-kanan {
      color: #ffffff;
      font-size: 15px;
      font-weight: 500;
    }

    .status-sedang {
      color: #ffffff;
    }

    /* Garis Pembatas DiAtas Detail Pesanan */
    /* .pembatas {
      border: none;
      height: 1px;
      background-color: #ccc;
      margin: 10px 0;
    } */

    .btn-wrapper {
      text-align: right;
      margin-top: 10px;
    }

    /* Button Detail Pemesanan */
    /* .btn-detail {
      background-color: #5c3a0c;
      color: #fff8e7;
      padding: 8px 20px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-family: 'Poppins', sans-serif;
    } */

    .btn-detail:hover {
      background-color: #7b5013;
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
        <a href="Pembayaran.php">Pembayaran</a>
        <a href="Dibuat.php">Dibuat</a>
        <a href="Dikirim.php" class="sub-active">Dikirim</a>
        <a href="Selesai.php">Selesai</a>
      </div>
      <div class="sub-divider"></div>
    </div>

    <!-- Tab Dikirim -->
    <div class="tab-content-wrapper">
      <div class="tab-content" id="dibuat-tab" style="display: block;">
        <div class="pesanan-box">
          <div class="pesanan-kiri">
            <img src="Gambar/menuwedangronde.png" alt="Wedang Ronde" class="produk-img">
            <div class="produk-detail">
              <div class="produk-nama">Wedang Ronde</div>
              <div class="produk-jumlah">Jumlah : 3</div>
            </div>
          </div>
          <div class="pesanan-kanan">
            <div class="status-sedang">Sedang Dikirim</div>
          </div>
        </div>
        <!-- class dari Pembatas -->
        <!-- <hr class="pembatas"> -->
        <div class="btn-wrapper">
            <!-- Button Detail Pemesanan -->
          <!-- <button class="btn-detail">Detail Pemesanan</button> -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>