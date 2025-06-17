<?php
session_start();
$keranjang=isset($_SESSION['keranjang'])?$_SESSION['keranjang']:[];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        img {
            border-radius: 5px;
            margin-right: 10px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      font-family: 'Poppins', sans-serif;
      height: 100%;
    }
    .hero {
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
    }
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
    .menu {
      display: flex;
      gap: 50px;
    }
    .menu a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      position: relative;
      font-size: 1.5rem;
      margin-left: 18px;
    }

    .menu a:hover,
    .menu a.active {
      border-bottom: 2px solid white;
    }
    .content {
      position: relative;
      z-index: 2;
    }
    .cart-header {
      display: flex;
      justify-content: space-between;
      padding: 0 320px;
      font-weight: bold;
      color: white;
      font-size: 1.4rem;
      margin-top: 40px;
      font-size:20px;
    }
    .cart-item {
  display: grid;
  grid-template-columns: 80px 40px 40fr 210px 250px 150px 10px;
  align-items: center;
  padding: 20px 70px;
  gap: 90px;
  margin-right: 90px;
  font-size: 18px;
  margin-top: 30px;
}
.checkbox input[type="checkbox"] {
  margin: 0 auto;
  display: block;
  width: 30px;
  height: 30px;
}
.product-img img {
  width: 100px;
  height: 100px;
  border-radius: 10px;
}
.product-name {
  font-weight: bold;
  flex: 1;
  text-align: left; 
}
.product-price,
.product-quantity,
.product-total {
  text-align: center; 
}
.product-action .hapus {
  background-color: #543A14;
  border: none;
  padding: 10px 30px;
  color: white;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
  margin-left: -40px;
  font-size:15px;
}
.product-action .hapus:hover {
  background-color: #8a541b;
  transition: background-color 0.3s ease;
}
.line-divider {
  border: none;
  height: 2px;
  background-color: white;
  opacity: 0.7;
  width: 85%;
  margin: 15px auto;
}
.product-quantity button {
  background-color: #543A14;
  border: none;
  font-size: 1.5rem; 
  padding: 5px 12px; 
  border-radius: 5px; 
  font-weight: bold;
  cursor: pointer;
  color:white;
}
.product-quantity button:hover {
  background-color: #A66C23; 
  color: white;          
  transition: 0.3s ease; 
}
.product-quantity span {
  font-size: 1.6rem; 
  margin: 0 20px;
}
/* tomblol checkout */
.checkout-container {
  position: relative;
  z-index: 2;
  display: flex;
  justify-content: flex-end;
  padding: 20px 80px 40px 0;
  margin-top: -120px;
}
.checkout-button {
  background-color: #543A14;
  border: none;
  padding: 12px 30px;
  color: white;
  border-radius: 5px;
  font-weight: bold;
  font-size: 18px;
  cursor: pointer;
}
.checkout-button:hover {
  background-color: #8a541b;
  transition: background-color 0.3s ease;
}
@media (max-width: 768px) {
  .cart-item {
    grid-template-columns: 1fr;
    padding: 20px;
    gap: 10px;
  }
  .cart-header {
    flex-direction: column;
    padding: 0 20px;
  }
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
    <div class="content">
      <div class="cart-header">
        <span>Produk</span>
        <span>Harga</span>
        <span>Jumlah</span>
        <span>Total</span>
      </div>
      <?php foreach ($keranjang as $id => $item): ?>
<div class="cart-item">
  <div class="checkbox">
   <input type="checkbox" class="product-checkbox"
  data-id="<?= $id ?>"
  data-nama="<?= htmlspecialchars($item['nama']) ?>"
  data-jumlah="<?= htmlspecialchars($item['jumlah']) ?>"
  data-harga="<?= htmlspecialchars($item['harga']) ?>">
  </div>
  <div class="product-img">
    <img src="Gambar_Produk/<?= htmlspecialchars($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama']) ?>">
  </div>
  <div class="product-name"><?= htmlspecialchars($item['nama']) ?></div>
  <div class="product-price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></div>
  <div class="product-quantity">
    <button class="btn-minus">-</button>
    <span class="quantity"><?= $item['jumlah'] ?></span>
    <button class="btn-plus">+</button>
  </div>
  <div class="product-total">Rp. <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></div>
  <div class="product-action">
    <form method="post" action="hapus_keranjang.php">
  <input type="hidden" name="id" value="<?= $id ?>">
  <button type="submit" class="hapus">Hapus</button>
</form>
  </div>
</div>
<?php endforeach; ?>
<hr class="line-divider">
    </div>
  </div>
<script>
  document.querySelectorAll('.cart-item').forEach(function(item) {
  const minusBtn = item.querySelector('.btn-minus');
  const plusBtn = item.querySelector('.btn-plus');
  const quantityEl = item.querySelector('.quantity');
  const priceEl = item.querySelector('.product-price');
  const totalEl = item.querySelector('.product-total');
  const price = parseInt(priceEl.textContent.replace(/[^\d]/g, ''));
  const id = item.querySelector('.product-checkbox').dataset.id;

  plusBtn.addEventListener('click', function() {
    let quantity = parseInt(quantityEl.textContent);
    quantity++;
    quantityEl.textContent = quantity;
    totalEl.textContent = "Rp. " + (quantity * price).toLocaleString("id-ID");
    updateJumlahKeServer(id, quantity);
  });

  minusBtn.addEventListener('click', function() {
    let quantity = parseInt(quantityEl.textContent);
    if (quantity > 1) {
      quantity--;
      quantityEl.textContent = quantity;
      totalEl.textContent = "Rp. " + (quantity * price).toLocaleString("id-ID");
      updateJumlahKeServer(id, quantity);
    }
  });
});
  //========================================================================================
</script>
<?php if (!empty($keranjang)) : ?>
  <div class="checkout-container" id="checkoutContainer" style="display:none;">
    <form id="checkoutForm" action="Pembayaran.php" method="post">
  <?php foreach ($keranjang as $id => $item): ?>
    <input type="hidden" name="produk[<?= $id ?>][nama]" value="<?= htmlspecialchars($item['nama']) ?>">
    <input type="hidden" name="produk[<?= $id ?>][jumlah]" value="<?= htmlspecialchars($item['jumlah']) ?>">
    <input type="hidden" name="produk[<?= $id ?>][harga]" value="<?= htmlspecialchars($item['harga']) ?>">
  <?php endforeach; ?>
  <button type="submit" class="checkout-button">Checkout</button>
</form>
  </div>
<?php endif; ?>
<!-- Untuk Tombol Checklist -->
 <script>
 const checkboxes = document.querySelectorAll('.product-checkbox');
  const checkoutContainer = document.getElementById('checkoutContainer');
  function updateCheckoutVisibility() {
    const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
    checkoutContainer.style.display = anyChecked ? 'flex' : 'none';
  }
  checkboxes.forEach(cb => {
    cb.addEventListener('change', updateCheckoutVisibility);
  });
  updateCheckoutVisibility();
</script>
<script>
  document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const form = this;

    // Hapus input hidden lama
    document.querySelectorAll('.hidden-dynamic').forEach(el => el.remove());
    let anyChecked = false;
    checkboxes.forEach(cb => {
      if (cb.checked) {
        anyChecked = true;
        const id = cb.dataset.id;
        const nama = cb.dataset.nama;
        const jumlah = cb.dataset.jumlah;
        const harga = cb.dataset.harga;
        // Buat input hidden untuk tiap data
        ['nama', 'jumlah', 'harga'].forEach(key => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `produk[${id}][${key}]`;
          input.value = (key === 'nama') ? nama :
               (key === 'jumlah') ? jumlah :
               harga;

          input.classList.add('hidden-dynamic');
          form.appendChild(input);
        });
      }
    });
    if (!anyChecked) {
      e.preventDefault();
      alert('Pilih Salah Satu Produk Yang Ingin Dipesan');
    }
  });
</script>
<script>
function updateJumlahKeServer(id, jumlah) {
  fetch('update_keranjang.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `id=${encodeURIComponent(id)}&jumlah=${encodeURIComponent(jumlah)}`
  })
  .then(response => response.json())
  .then(data => {
    console.log('Jumlah diperbarui:', data);
  })
  .catch(error => {
    console.error('Gagal update jumlah:', error);
  });
}
</script>
</body>
</html>
