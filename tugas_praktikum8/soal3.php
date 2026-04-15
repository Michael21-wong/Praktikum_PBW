<html>
    <body>
        <header>
            <h3>Soal No 3</h3>
        </header>
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
        <form method="post" action="">
            <label>Hewan Pertama
                <input type="text" name="hewan[]">
            </label><br>
        
            <label>Hewan Kedua
                <input type="text" name="hewan[]">
            </label><br>
        
            <label>Hewan Ketiga
                <input type="text" name="hewan[]">
            </label><br>
        
            <label>Hewan Keempat
                <input type="text" name="hewan[]">
            </label><br>
        
            <label>Hewan Kelima
                <input type="text" name="hewan[]">
            </label><br>
        
            <input type="submit" name="submit" value="submit">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $hewan = $_POST['hewan'];
            echo "Hewan yang dimasukkan: <br>";
            foreach ($hewan as $h) {
                echo "- $h<br>";
            }
        }
        ?>
    </body>
</html>