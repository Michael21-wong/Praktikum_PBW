<?php
// Parameter: host, username, password, nama_database
$conn = new mysqli('localhost', 'root', '', 'pemrograman_web_contoh');

// Mengecek apakah terjadi kesalahan koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>