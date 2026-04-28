<?php
include 'koneksi.php';

$pesan = ""; // Variabel untuk menampung pesan sukses/gagal

if (isset($_POST['submit'])) {
    $judul     = $_POST['judul'];
    $platform  = $_POST['platform'];
    $genre     = $_POST['genre'];
    $rating    = $_POST['rating'];
    $rilis     = $_POST['rilis'];
    $developer = $_POST['developer'];

    // 1. Gunakan Prepared Statement (Ketentuan No. 4)
    $stmt = $koneksi->prepare("INSERT INTO game (judul, platform, genre, rating, rilis, developer) VALUES (?, ?, ?, ?, ?, ?)");
    
    // "sssiis" artinya: string, string, string, integer, integer, string (sesuaikan tipe data)
    $stmt->bind_param("sssiis", $judul, $platform, $genre, $rating, $rilis, $developer);

    // 2. Tampilkan pesan sukses/gagal (Ketentuan No. 5)
    if ($stmt->execute()) {
        $pesan = "<div class='alert alert-success'>Data game berhasil ditambahkan! <a href='index.php'>Lihat Data</a></div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambahkan data: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Koleksi Game</h4>
        </div>
        <div class="card-body">
            <?= $pesan ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Judul Game</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Platform</label>
                        <input type="text" name="platform" class="form-control" placeholder="PC, PS5, dll.">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <input type="text" name="genre" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating (1-10)</label>
                        <input type="number" name="rating" class="form-control" min="1" max="10">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Rilis</label>
                        <input type="number" name="rilis" class="form-control" placeholder="YYYY">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Developer</label>
                    <input type="text" name="developer" class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-success">Simpan Game</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>