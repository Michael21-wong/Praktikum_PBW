<html>
    <body>
        <header>
            <h3>Soal No 4</h3>
        </header>
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>

        <form method="post" action="">
            <label for="angka">Masukkan Angka:</label>
            <input type="number" id="angka" name="angka" required><br><br>
            <input type="submit" name="Submit" value="Submit">
        </form>
        <?php
            if (isset($_POST['Submit'])) {
                $angka = $_POST['angka'];
                $status = ($angka % 2 == 0) ? "Genap" : "Ganjil";
                echo "Angka $angka adalah $status.";
            }
        ?>
    </body>
</html>