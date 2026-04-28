<?php
include 'koneksi.php';

$id = $_GET['id'];
$pesan = "";

// 1. Ambil data lama untuk ditampilkan di form
$stmt_get = $koneksi->prepare("SELECT * FROM game WHERE id_game = ?");
$stmt_get->bind_param("i", $id);
$stmt_get->execute();
$result = $stmt_get->get_result();
$data = $result->fetch_assoc();

// 2. Proses update jika form disubmit
if (isset($_POST['update'])) {
    $judul     = $_POST['judul'];
    $platform  = $_POST['platform'];
    $genre     = $_POST['genre'];
    $rating    = $_POST['rating'];
    $rilis     = $_POST['rilis'];
    $developer = $_POST['developer'];

    $stmt_update = $koneksi->prepare("UPDATE game SET judul=?, platform=?, genre=?, rating=?, rilis=?, developer=? WHERE id_game=?");
    $stmt_update->bind_param("sssiisi", $judul, $platform, $genre, $rating, $rilis, $developer, $id);

    if ($stmt_update->execute()) {
        header("Location: index.php?status=update_berhasil");
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal update: " . $stmt_update->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Data Game</h4>
        </div>
        <div class="card-body">
            <?= $pesan ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Judul Game</label>
                    <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Platform</label>
                        <input type="text" name="platform" class="form-control" value="<?= $data['platform'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genre</label>
                        <input type="text" name="genre" class="form-control" value="<?= $data['genre'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating</label>
                        <input type="number" name="rating" class="form-control" min="1" max="10" value="<?= $data['rating'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Rilis</label>
                        <input type="number" name="rilis" class="form-control" value="<?= $data['rilis'] ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Developer</label>
                    <input type="text" name="developer" class="form-control" value="<?= $data['developer'] ?>">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>