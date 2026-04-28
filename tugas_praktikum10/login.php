<?php
session_start();
require_once 'koneksi.php';

// Jika sudah login, langsung lempar ke index
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Gunakan Prepared Statement untuk keamanan dari SQL Injection
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Cek password (teks biasa sesuai request kamu)
        if ($pass == $row['password']) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] = $row['nama_lengkap'];
            $_SESSION['role'] = $row['role']; // Menyimpan apakah dia 'admin' atau 'user'
            
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Katalog Game</title>
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
<div class="container">
    <div class="card mx-auto shadow-lg" style="max-width: 400px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">🎮 GameList Login</h3>
            
            <?php if(isset($error)) : ?>
                <div class="alert alert-danger py-2 text-center">Username atau Password salah!</div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 py-2">Masuk Sekarang</button>
            </form>
            
            <div class="mt-3 text-center">
                <small class="text-muted">Coba login sebagai admin1 atau user1</small>
            </div>
        </div>
    </div>
</div>
</body>
</html>