<?php
$conn = new mysqli ("localhost", "root", "", "db_wedang_ronde");
if ($conn->connect_error) {
  die("koneksi gagal: ".$conn->connect_error);
} 
$sql = "SELECT nama_galeri FROM t_galeri ORDER BY id_galeri DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galeri</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" /> -->
    <link rel="stylesheet" href="wedangstyle.css" />
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      .gallery-container {
        position: relative;
        z-index: 2;
        padding: 0;
        margin-top: -70px;
      }
      .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 50px;
        justify-items: center;
      }
      .gallery-item {
        width: 210px;
        aspect-ratio: 4 / 4.8;
        display: inline-block;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 12px;
        border: 2px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
        margin-top: 0;
      }
      .gallery-item img {
        width: 98%;
        height: 98%;
        object-fit: cover;
        display: block;
        border-radius: 10px;
        transition: transform 0.3s ease;
        cursor: pointer;
      }
      .gallery-item:hover img {
        transform: scale(1.05);
      }
      /* Tombol Upload */
      .upload-button {
        position: fixed;
        bottom: 170px;
        right: 105px;
        background-color: #5d3a00;
        color: white;
        border: none;
        padding: 10px 18px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        z-index: 100;
        transition: background-color 0.3s ease;
      }
      .upload-button:hover {
        background-color: #7a4f00;
      }
      /* Lightbox overlay */
      .lightbox-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
      }
      .lightbox-overlay img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        transition: transform 0.3s ease;
        cursor: pointer;
      }
      /* Form Upload Container */
      #uploadForm {
        position: fixed;
        bottom: 220px;
        right: 100px;
        background: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 101;
      }
    </style>
</head>
<body>
  <div class="hero">
    <div class="overlay"></div>
    <header class="navbar">
      <div class="logo">
        <img src="Gambar/logowedangronde.png" alt="Wedang Ronde Logo" />
        <h1>Wedang <br>
         Ronde</h1>
      </div>
      <nav class="menu">
        <a href="Beranda.php">Beranda</a>
        <a href="Menu.php">Menu</a>
        <a href="Sejarah.php">Sejarah</a>
        <a href="Galeri.php" class="active">Galeri</a>
        <a href="Keranjang.php">Keranjang</a>
        <a href="Profil">Profil</a>
      </nav>
    </header>

    <div class="gallery-container">
      <div class="gallery">
        <?php
          if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="gallery-item">';
        echo '<img src="Gambar/' . htmlspecialchars($row['nama_galeri']) . '" alt="Gambar Galeri">';
        echo '</div>';
      }
    } else {
      echo "<p>Belum ada gambar di galeri.</p>";
    }
    $conn->close();
        ?>
      </div> <!-- tutup gallery -->
    </div> <!-- tutup gallery-container -->

    <!-- Lightbox -->
    <div class="lightbox-overlay" id="lightbox">
      <img id="lightbox-img" src="" alt="Lightbox Image" />
    </div>
    <button class="upload-button" onclick="toggleForm()">Upload Gambar</button>
    <div id="uploadForm" style="display: none;">
      <form action="upload_gambar.php" method="post" enctype="multipart/form-data">
        <input type="file" name="gambar" accept="image/*" required /><br /><br />
        <button type="submit">Kirim</button>
        <button type="button" id="cancelUpload">Batal</button>
      </form>
    </div>
  </div>
  <script>
    function toggleForm() {
      const form = document.getElementById('uploadForm');
      form.style.display = form.style.display === 'block' ? 'none' : 'block';
    }

    document.getElementById('cancelUpload').addEventListener('click', () => {
      document.getElementById('uploadForm').style.display = 'none';
    });
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    document.querySelectorAll('.gallery-item img').forEach(img => {
      img.addEventListener('click', () => {
        lightboxImg.src = img.src;
        lightbox.style.display = 'flex';
      });
    });

    lightbox.addEventListener('click', () => {
      lightbox.style.display = 'none';
    });
  </script>
</body>
</html>