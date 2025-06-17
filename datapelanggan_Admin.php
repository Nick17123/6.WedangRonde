<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
session_start();

//Mengkoneksian ke dalam databse
$conn = new mysqli("localhost", "root", "","db_wedang_ronde");
if ($conn->connect_error) {
  die("Koneksi Gagal: " .$conn->connect_error);
}

// Kode untuk mengambil data customer
// Prepared stmt
$stmt = $conn->prepare ("SELECT id_customer, nama_customer, alamat_customer, nohp_customer, jk_customer, email FROM t_customer ORDER BY id_customer ASC");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pelanggan</title>
  <link rel="stylesheet" href="style.css">
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

    .sidebar ul li a.active::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -5px;
      width: 130px;
      height: 4px;
      background-color: white;
    }

    .table-container {
      margin: 40px;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      overflow-x: auto;
    }
    
    /* Panjang Tabel  */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #5b4220;
      color: white;
    }
    /* lebar samping isi kolom data  */
    th, td {
      padding: 8px 17px;
      text-align: center;
    }

    td {
      font-size: 14px;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    a.btn-hapus, a.btn-edit {
  background-color: #5b4220;
  color: white;
  padding: 5px 12px;
  margin-right: 5px;
  margin-left: 8px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 12px;
  display: inline-block;
}
a.btn-hapus:hover, a.btn-edit:hover {
  opacity: 0.85;
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
  </style>
</head>
<body>
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
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No.Hp</th>
              <th>jenis kelamin</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
  <?php
        if ($result->num_rows > 0) {
  $no = 1; // digunakan untuk nomor urut
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td><strong>" . htmlspecialchars($row['nama_customer']) . "</strong></td>";
    echo "<td>" . htmlspecialchars($row['alamat_customer']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nohp_customer']) . "</td>";
    echo "<td>" . htmlspecialchars($row['jk_customer']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
   echo "<td>
  <a href='edit_Customer.php?id=" . $row['id_customer'] . "' class='btn-edit'>Edit</a>
  <a href='hapus_Customer.php?id=" . $row['id_customer'] . "' class='btn-hapus'>Hapus</a>
</td>";

    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='7'>Data Pelanggan Tidak Ditemukan</td></tr>";
}
$stmt->close();
$conn->close();
        ?>
  </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<script>
function hapusData(event, element) {
    event.preventDefault();
    const id = element.getAttribute('data-id');

    if (confirm('Yakin ingin menghapus data ini?')) {
        fetch('hapus_Customer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + encodeURIComponent(id)
        })
        .then(response => response.text())
        .then(data => {
            alert('Data berhasil dihapus.');
            location.reload(); // refresh halaman agar data terupdate
        })
        .catch(error => {
            alert('Terjadi kesalahan saat menghapus data.');
            console.error(error);
        });
    }
}
</script>

</html>
