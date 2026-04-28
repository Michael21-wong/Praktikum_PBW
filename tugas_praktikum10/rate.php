<?php
session_start();
// Proteksi: Hanya yang sudah login yang bisa akses
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];
$pesan = "";

$stmt = $koneksi->prepare("SELECT judul, rating FROM game WHERE id_game = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$game = $stmt->get_result()->fetch_assoc();

// Di dalam file rate.php, cari bagian proses submit
if (isset($_POST['submit_rate'])) {
    $rating_user = $_POST['rating_user'];
    $id_user = $_SESSION['id_user']; // ID user yang lagi login

    // Masukkan ke tabel rating (BUKAN update tabel game)
    $stmt = $koneksi->prepare("INSERT INTO rating (id_game, id_user, skor) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id, $id_user, $rating_user);

    if ($stmt->execute()) {
        header("Location: index.php?status=rating_berhasil");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rate - <?= $game['judul'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
    body { 
        background-color: #121212; 
        color: #ffffff; 
    }

    .card { 
        background-color: #1e1e1e; 
        border: 1px solid #333; 
        color: white; 
        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
    }

    .form-label {
        color: #f0f0f0; /* Putih terang agar terbaca jelas */
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control { 
        background-color: #2c2c2c; 
        border: 1px solid #444; 
        color: #ffffff !important; /* Memastikan teks yang diketik berwarna putih */
    }

    .form-control::placeholder {
        color: #bbbbbb !important; /* Warna abu-abu terang agar kelihatan */
        opacity: 1; 
    }

    .form-control:focus { 
        background-color: #333; 
        color: white; 
        border-color: #0d6efd; 
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .text-muted {
        color: #aaaaaa !important;
    }
</style>
</head>
<body class="d-flex align-items-center" style="height: 100vh;">
<div class="container text-center">
    <div class="card mx-auto p-4 shadow-lg" style="max-width: 450px;">
        <h3 class="mb-4">Beri Rating Anda</h3>
        <h5 class="text-info mb-3"><?= $game['judul'] ?></h5>
        <p class="text-muted small">Rating saat ini: ⭐ <?= $game['rating'] ?>/10</p>
        
        <?= $pesan ?>

        <form action="" method="POST">
            <div class="mb-3">
                <input type="number" name="rating_user" class="form-control text-center fs-4" 
                       min="1" max="10" placeholder="1 - 10" required>
                <div class="form-text text-secondary">Skala 1 (Buruk) sampai 10 (Masterpiece)</div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="submit_rate" class="btn btn-primary py-2">Kirim Rating</button>
                <a href="index.php" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>