<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedang Ronde - Login</title>
</head>
<body style="background-color: #fdeedc; font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <header style="background-color: #6b4f27; color: white; text-align: center; padding: 20px; font-size: 24px; font-weight: bold;">
    Wedang Ronde
    </header>
    
<div style="display: flex; justify-content: center; align-items: center; height: 90vh;">
    <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 350px;">
     <h2 style="text-align: center; color: #6b4f27;">LOGIN</h2>
         <form action="login_proses.php" method="POST">
            <label>Email :</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;"> 

            <label>Password :</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;">

            <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
                <a href="Lupa.php" style="padding: 5px; margin: 5px 0;">Lupa Password?</a>
                <a href="Daftar.php" style="padding: 5px; margin: 5px 0;">Daftar akun?</a>
            </div>

            <button type="submit" style="width: 100%; background-color: #6b4f27; color: white; padding: 10px; font-size: 16px; border: none; border-radius: 10px; margin-top: 10px; cursor: pointer;">
                Login
            </button>
        </form>
    </div>
</div>
</body>
</html>
