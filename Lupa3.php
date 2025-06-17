<?php
session_start();
include 'koneksi.php'; // koneksi ke database

// Cek apakah user sudah login dari proses sebelumnya
if (!isset($_SESSION['id_customer'])) {
    echo "<script>alert('Akses tidak sah!'); window.location.href='Login.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_customer = $_SESSION['id_customer'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Cek apakah password dan konfirmasi cocok
    if ($password_baru === $konfirmasi_password) {
        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

        $query = "UPDATE t_customer SET password_customer = ? WHERE id_customer = ?";
        $stmt = $con->prepare($query);

        if ($stmt) {
            $stmt->bind_param("si", $hashed_password, $id_customer);
            if ($stmt->execute()) {
                // Setelah update, bisa logout dan redirect ke login
                session_destroy();
                echo "<script>alert('Password berhasil diubah. Silakan login kembali.'); window.location.href='Login.php';</script>";
            } else {
                echo "<script>alert('Gagal mengubah password.'); window.location.href='Lupa3.php';</script>";
            }
        } else {
            echo "Query Error: " . $con->error;
        }
    } else {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='Lupa3.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedang Ronde - Lupa Password</title>
</head>
<body style="background-color:#fdeedc; font-family:Arial,sans-serif; margin:0 ; padding:0;">
    <header style="background-color:#6b4f27; color:white; text-align:center; padding:20px; font-size:24px; font-weight:bold;">Wedang Ronde</header>
    <div style="display: flex; justify-content: center; align-items: center; height: 90vh;">
        <div style="background-color: white; padding: 30px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 350px;height:300px; text-align: center;">
        <h1 style="color:#6b4f27">Reset Password</h1>   
        <form method="POST" action="Index.php">
            <label style="text-align: left;display: block;">Masukkan Password Baru</label>
            <input type="password" style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;box-sizing: border-box;" name="password_baru" required>
            <label style="text-align: left;display: block;">Konfirmasi Password</label>
            <input type="password" style="width: 100%; padding: 8px; margin: 5px 0; background-color: #fdeedc; border: none; border-radius: 10px;box-sizing: border-box ;" name="konfirmasi_password" required>

            <button type="submit" style="width: 100%; background-color: #6b4f27;box-sizing: border-box; color: white; padding: 10px; font-size: 16px; border: none; border-radius: 10px; margin-top: 25px; cursor: pointer;">Konfirmasi</button>
        </form>
    </div> 
</html>