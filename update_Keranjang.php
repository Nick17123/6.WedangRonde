<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $jumlah = intval($_POST['jumlah'] ?? 1);

    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]['jumlah'] = $jumlah;
        echo json_encode(['success' => true, 'jumlah' => $jumlah]);
    } else {
        echo json_encode(['success' => false, 'error' => 'ID tidak ditemukan']);
    }
    exit;
}
echo json_encode(['success' => false, 'error' => 'Metode tidak valid']);
