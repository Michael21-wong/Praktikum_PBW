<?php
include 'koneksi_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // 🔥 1. Hapus dulu dari detail_pesanan
        $stmt = $conn->prepare("DELETE FROM detail_pesanan WHERE id_buku = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // 🔥 2. Baru hapus dari buku
        $stmt = $conn->prepare("DELETE FROM Buku WHERE ID = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Data buku dan detail pesanan berhasil dihapus');
            window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . addslashes($stmt->error) . "');
            window.location='index.php';</script>";
        }

        $stmt->close();

    } else {
        echo "<script>alert('ID tidak valid');
        window.location='index.php';</script>";
    }

$conn->close();
?>