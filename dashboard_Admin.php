<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>
<?php
// koneksi
$conn = new mysqli("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ambil data dari database t_produk
$stmt = $conn->prepare("SELECT id_produk, nama_produk, harga_produk, gambar_produk FROM t_produk ORDER BY id_produk ASC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Tambah SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

/* Garis bawah disembunyikan dulu */
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

/* Saat cursor hover, munculkan garis */
.sidebar ul li a:hover::after {
  width: 100%;
}

/* Jika sedang aktif, garis tetap penuh */
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

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #5b4220;
      color: white;
    }

    th, td {
      padding: 19px 100px;
      text-align: center;
    }

    td {
      font-size: 14px;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    button.btn-hapus, button.btn-edit {
      background-color: #5b4220;
      color: white;
      border: none;
      padding: 5px 12px;
      margin-right: 5px;
      margin-left: 8px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 12px;
    }

    button.btn-hapus:hover,
    button.btn-edit:hover {
      opacity: 0.85;
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
    .btn-tambah {
  position: absolute;
  right: 50px;
  bottom: 40px;
  background-color: #5b4220;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  font-size: 14px;
  border-radius: 8px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

.btn-tambah:hover {
  background-color: #755b35;
}
.btn-group {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px; /* jarak antar tombol */
}

  </style>
</head>
<body>
  <!-- Bagian Animasi Setelah Berhasil Ditambahkan -->
 <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Produk berhasil ditambahkan.',
        confirmButtonColor: '#5b4220'
    });
</script>
<?php endif; ?>

  <div class="background">
    <!-- Header -->
    <div class="header">
      <img src="Gambar/logowedangronde.png" alt="Logo Wedang Ronde" class="logo">
      <div class="title">WEDANG RONDE</div>
    </div>

    <!-- Sidebar Navigasi -->
    <div class="sidebar">
      <ul>
        <li><a href="dashboard_Admin.php" class="<?= ($currentPage == 'dashboard_Admin.php') ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="galeri_Admin.php" class="<?= ($currentPage == 'galeri_Admin.php') ? 'active' : '' ?>">Galeri</a></li>
        <li><a href="pesanan_Admin.php" class="<?= ($currentPage == 'pesanan_Admin.php') ? 'active' : '' ?>">Pesanan</a></li>
        <li><a href="datapelanggan_Admin.php" class="<?= ($currentPage == 'datapelanggan_Admin.php') ? 'active' : '' ?>">Data Pelanggan</a></li>
        <li><a href="riwayatpembelian_Admin.php" class="<?= ($currentPage == 'riwayatpembelian_Admin.php') ? 'active' : '' ?>">Riwayat Pembelian</a></li>
      </ul>
    </div>

    <!-- Konten Utama -->
    <div class="content-box">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
  <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
      <td><?= $row['id_produk']; ?></td>
      <td><strong><?= htmlspecialchars($row['nama_produk']); ?></strong></td>
      <td>Rp. <?= number_format($row['harga_produk'], 0, ',', '.'); ?></td>
      <td>
        <img src="Gambar_Produk/<?= htmlspecialchars($row['gambar_produk']); ?>" alt="Gambar Produk" width="100" style="border-radius: 6px;">
      </td>
      <td>
  <div class="btn-group">
    <button class="btn-edit" onclick="location.href='editproduk_Admin.php?id=<?= $row['id_produk']; ?>'">Edit</button>
    <button class="btn-hapus" onclick="confirmDelete(<?= $row['id_produk']; ?>)">Hapus</button>
  </div>
</td>
    </tr>
  <?php endwhile; ?>
</tbody>
        </table>
        <a href="tambah_produk.php" class="btn-tambah">+ Tambah Produk</a>
      </div>
    </div>
  </div>
  <script>
  function confirmDelete($id) {
    Swal.fire({
      title: 'Yakin Menghapus Produk Ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#5b4220',
      cancelButtonColor: '#543A14',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'hapus_produk.php?id=' + $id;
      }
    });
  }
</script>

</body>
</html>
