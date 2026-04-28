<?php
include 'koneksi.php';

// Cek apakah ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Gunakan Prepared Statement untuk keamanan
    $stmt = $koneksi->prepare("DELETE FROM game WHERE id_game = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali ke index.php dengan pesan sukses
        header("Location: index.php?status=hapus_berhasil");
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
} else {
    die("ID tidak ditemukan.");
}
?>