<html>
    <body>
        <header>
            <h3>Soal No 2</h3>
        </header>
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
        <form method="post" action="">
            <label for="angka1">Angka Awal:</label>
            <input type="number" id="angka1" name="angka1" required><br>
            <label for="angka2">Angka Akhir:</label>
            <input type="number" id="angka2" name="angka2" required><br>
            <input type="submit" name="Submit" value="Submit">
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            $batas = $_POST['angka2'];
            echo "<h3>Angka Genap:</h3>\n";
            for ($i = $_POST['angka1']; $i <= $batas; $i++) {
                if ($i % 2 == 0) {
                    echo "$i<br>\n";
                }
            }
            echo "<h3>Angka Ganjil:</h3>\n";
            for ($i = $_POST['angka1']; $i <= $batas; $i++) {
                if ($i % 2 != 0) {
                    echo "$i<br>\n";
                }
            }
        }
        ?>
    </body>
</html>