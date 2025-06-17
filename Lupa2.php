<?php
session_start();
include 'koneksi.php'; // koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Ambil data customer berdasarkan email
    $query = "SELECT * FROM t_customer WHERE email = ?";
    $stmt = $con->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Jika email ditemukan
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['id_customer'] = $user['id_customer'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_customer'] = $user['nama_customer'];

            // Redirect ke halaman penggantian password
            header("Location: Lupa3.php");
            exit();
        } else {
            echo "<script>alert('Email tidak terdaftar!'); window.location.href='Index.php';</script>";
        }
    } else {
        echo "Query Error: " . $con->error;
    }
}
?>
