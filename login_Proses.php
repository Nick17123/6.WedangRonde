<?php
session_start();
include 'koneksi.php'; // koneksi ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Ambil data customer berdasarkan email
    $query = "SELECT * FROM t_customer WHERE email = ?";
    $stmt = $con->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        // Jika user ditemukan
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $hash = $user['password_customer'];
            // Verifikasi password
            if (password_verify($password, $hash)) {
                $_SESSION['nama_customer'] = $user['nama_customer'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id_customer'] = $user['id_customer'];
                header("Location: beranda.php");
                exit();
            } else {
                echo "<script>alert('Password salah!'); window.location.href='Index.php';</script>";
            }
        } else {
            echo "<script>alert('Email tidak terdaftar!'); window.location.href='Index.php';</script>";
        }
    } else {
        echo "Query Error: " . $con->error;
    }
}
?>
