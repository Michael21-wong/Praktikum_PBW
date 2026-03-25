<?php
define("PAJAK",0.10);

$barang = ["Keyboard"=>150000,"Mouse"=>50000,"Monitor"=>2000000];

$nama_barang = "Keyboard";
$jumlah_beli = 2;
$harga_satuan = $barang[$nama_barang];

$total = $harga_satuan * $jumlah_beli;
$pajak = $total * PAJAK;
$total_bayar = $total + $pajak;

echo "<h2>Perhitungan Harga Barang</h2>";
echo "Nama Barang: $nama_barang <br>";
echo "Jumlah Beli: $jumlah_beli <br>";
echo "Total Harga (Sebelum Pajak): $total <br>";
echo "Pajak (10%): $pajak <br>";
echo "<b>Total Bayar: $total_bayar </b>";
?>