<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$batas = 10; 
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$search = isset($_GET['cari']) ? $_GET['cari'] : "";
$search_param = "%$search%";

$query_tampil = "SELECT * FROM game WHERE judul LIKE ? OR genre LIKE ?";
$stmt_total = $koneksi->prepare($query_tampil);
$stmt_total->bind_param("ss", $search_param, $search_param);
$stmt_total->execute();
$total_data = $stmt_total->get_result()->num_rows;
$total_halaman = ceil($total_data / $batas);

$query_limit = "SELECT g.*, 
                (SELECT AVG(skor) FROM rating WHERE id_game = g.id_game) AS rating_user,
                COALESCE((SELECT AVG(skor) FROM rating WHERE id_game = g.id_game), g.rating) AS rating_tampil
                FROM game g 
                WHERE g.judul LIKE ? OR g.genre LIKE ? 
                LIMIT ?, ?";
$stmt = $koneksi->prepare($query_limit);
$stmt->bind_param("ssii", $search_param, $search_param, $halaman_awal, $batas);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GameList - Katalog Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-custom { background-color: #212529; color: white; padding: 15px; }
    </style>
</head>
<body>

<div class="navbar-custom d-flex justify-content-between align-items-center shadow-sm">
    <h4 class="mb-0 ms-3">🎮 MyGameList</h4>
    <div class="me-3">
        <span class="me-3 text-secondary">Login sebagai: <strong><?= $_SESSION['nama'] ?> (<?= ucfirst($_SESSION['role']) ?>)</strong></span>
        <a href="logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
    </div>
</div>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Koleksi Katalog Game</h2>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <a href="tambah.php" class="btn btn-primary shadow-sm">+ Tambah Game Baru</a>
            <?php else : ?>
                <button class="btn btn-secondary shadow-sm" disabled>Mode Lihat Saja</button>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <form action="" method="GET" class="d-flex">
                <input type="text" name="cari" class="form-control me-2 shadow-sm" placeholder="Cari judul atau genre..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-dark">Cari</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Judul</th>
                        <th>Platform</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Tahun</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                    <tr class="align-middle">
                        <td><?= $no++ ?></td>
                        <td><strong><?= $row['judul'] ?></strong></td>
                        <td><?= $row['platform'] ?></td>
                        <td><?= $row['genre'] ?></td>
                        <td>⭐ <?= number_format($row['rating_tampil'] ?? 0, 1) ?>/10</td>  
                        <td><?= $row['rilis'] ?></td>
                        
                        <td class="text-center">
                            <?php if ($_SESSION['role'] == 'admin') : ?>
                                <a href="edit.php?id=<?= $row['id_game'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id_game'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            <?php else : ?>
                                <a href="rate.php?id=<?= $row['id_game'] ?>" class="btn btn-sm btn-info text-white">
                                    ⭐ Beri Rating
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($halaman <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-secondary" 
                        href="?halaman=<?= $halaman - 1; ?>&cari=<?= $search; ?>">
                        &laquo; Ke Kiri (Sebelumnya)
                        </a>
                    </li>

                    <li class="page-item disabled">
                        <span class="page-link bg-secondary text-white border-secondary">
                            Halaman <?= $halaman; ?> dari <?= $total_halaman; ?>
                        </span>
                    </li>

                    <li class="page-item <?= ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-secondary" 
                        href="?halaman=<?= $halaman + 1; ?>&cari=<?= $search; ?>">
                        Ke Kanan (Berikutnya) &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<footer class="text-center mt-5 py-3 text-muted">
    <small>&copy; 2026 MyGameList - Project Pemrograman Web</small>
</footer>

</body>
</html>