<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedang Ronde - Lupa Password</title>
</head>
<body style="background-color: #fdeedc; font-family: Arial, sans-serif; margin: 0; padding: 0;">
        <header style="background-color: #6b4f27; color: white; text-align: center; padding: 20px; font-size: 24px; font-weight: bold;">Wedang Ronde</header>

    <div style="display: flex; justify-content: center; align-items: center; height: 90vh;">
        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 350px;height:300px">
            <h2 style="text-align: center; color: #6b4f27;">LUPA PASSWORD</h2>
            <p style="font-size:15px;margin-top:40px; font-weight: 200; color:black;">Masukkan alamat Email</p>

            <form action="Lupa2.php" method="POST">
                    <input type="email" name="email" placeholder="seseorang@gmail.com" required style="width: 100%; box-sizing:border-box; padding: 11px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;">
                    <button type="submit" style="width: 100%; background-color: #6b4f27;box-sizing: border-box; color: white; padding: 10px; font-size: 16px; border: none; border-radius: 10px; margin-top: 25px; cursor: pointer;">Kirim</button>
            </form>

            <p style="margin-top: 30px; font-size: 16px; text-align:center;"><a href="Index.php" style="padding: 5px; margin: 5px 0;">Kembali ke Login</a></p>
        </div>
    </div>

</body>
</html>

