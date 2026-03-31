<html>
    <head>
        <title>Tugas Praktikum 6</title>
    </head>
    <body>
        <form method="post" action="">
            Nama: <input type="text" name="nama"><br>
            Nilai: <input type="number" name="nilai"><br>
            <input type="submit" name="submit" value="proses">
        </form>
        <br>
        <br>
            <?php
           if (isset($_POST['submit'])) {
                $var_nama = $_POST['nama'];
                $var_nilai = $_POST['nilai'];

                echo "<h3>Hasil:</h3>";
                echo "Nama : $var_nama <br>";
                echo "Nilai : $var_nilai <br>";

                if ($var_nilai >= 86 && $var_nilai <= 100) {
                    $predikat = "A";
                    $status = "Lulus";
                } elseif ($var_nilai >= 75) {
                    $predikat = "B";
                    $status = "Lulus";
                } elseif ($var_nilai >= 65) {
                    $predikat = "C";
                    $status = "Lulus";
                } elseif ($var_nilai >= 50) {
                    $predikat = "D";
                    $status = "Lulus";
                } elseif ($var_nilai >= 0) {
                    $predikat = "E";
                    $status = "Tidak Lulus";
                } else {
                    $predikat = "Tidak Valid";
                    $status = "-";
                }

                echo "Predikat : $predikat <br>";
                echo "Status : $status <br>";
            }
            ?>
    </body>
</html>