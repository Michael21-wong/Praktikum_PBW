<html>
    <body>
        <form method="post" action="">
            <h3>Form Pembayaran UKT</h3>
            NPM: <input type="text" name="npm"><br><br>
            Nama: <input type="text" name="nama"><br><br>
            Prodi: <input type="text" name="prodi"><br><br>
            Semester: <input type="text" name="semester"><br><br>
            Biaya UKT: <input type="text" name="biaya"><br><br>

            <input type="submit" name="hitung" value="Hitung">
        </form>
        <?php
            if (isset($_POST['hitung'])) {

            $npm = $_POST['npm'];
            $nama = $_POST['nama'];
            $prodi = $_POST['prodi'];
            $semester = $_POST['semester'];
            $biaya = $_POST['biaya'];
 
            $diskon1 = 0;
            if ($biaya >= 5000000) {
                $diskon1 = 0.10 * $biaya;
            }

            $sisa = $biaya - $diskon1;

            $diskon2 = 0;
            if ($biaya >= 5000000 && $semester >= 8) {
                $diskon2 = 0.05 * $sisa;
            }

            $total_diskon = $diskon1 + $diskon2;
            $bayar = $biaya - $total_diskon;

            echo "<h3>Hasil Pembayaran UKT</h3>";
            echo "NPM : $npm <br>";
            echo "Nama : $nama <br>";
            echo "Prodi : $prodi <br>";
            echo "Semester : $semester <br>";
            echo "Biaya UKT : Rp " . number_format($biaya) . "<br>";
            echo "Total Diskon : Rp " . number_format($total_diskon) . "<br>";
            echo "Yang harus dibayar : Rp " . number_format($bayar) . "<br>";
            }
        ?>
    </body>
</html>