<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedang Ronde - Daftar</title>
</head>
<body style="background-color: #fdeedc; font-family: Arial, poppins; margin: 0; padding: 0;">
    <header style="background-color: #6b4f27; color: white; text-align: center; padding: 20px; font-size: 24px; font-weight: bold;">
    Wedang Ronde
    </header>
    
<div style="display: flex; justify-content: center; align-items: center; height: 90vh;">
    <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 350px;">
     <h2 style="text-align: center; color: #6b4f27;">DAFTAR</h2>
         <form action="proses_daftar.php" method="POST">
             <label>Nama Lengkap :</label>
             <input type="text" name="nama_customer" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none;border-radius: 10px;">  
            <label>Alamat :</label>
                <input type="text" name="alamat_customer" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;"> 
                <label>No Handphone :</label>
                <input type="number" name="nohp_customer" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;">
                <label>Jenis Kelamin :</label><br>
                <input type="radio" name="jk_customer" value="Laki-Laki" id="laki" required> <label for="laki">Laki-Laki</label>
                <input type="radio" name="jk_customer" value="Perempuan" id="perempuan"> <label for="perempuan">Perempuan</label> 
                <br><br>
                <label>Email :</label>
             <input type="email" name="email" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;"> 
            <label>Password :</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;">
            <label>Konfirmasi Password :</label>
            <input type="password" name="konfirmasi_password" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;">    

            <button type="submit" name="daftar" style="width: 100%; background-color: #6b4f27; color: white; padding: 10px; font-size: 16px; border: none; margin-top: 10px; cursor: pointer; border-radius: 10px;">
                Daftar
            </button>

            <!-- Tombol Kembali ke Login -->
            <a href="Index.php" style="display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #6b4f27; font-weight: bold;">
                Kembali ke Login
            </a>
        </form>
    </div>
</div>
</body>
</html>
