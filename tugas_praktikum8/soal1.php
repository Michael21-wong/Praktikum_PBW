<html>
    <body>
        <header>
            <h3>Soal No 1</h3>
        </header>
        <div class="menu">
            <?php include 'menu.php'; ?>
        </div>
        <form method="post" action="">
            <label for="roda">Roda:</label>
            <input type="text" id="roda" name="roda" required><br><br>
            <input type="submit" name="Submit" value="Submit">
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            switch ($_POST['roda']) {
                case '2':
                    echo "Sepeda";
                break;
            case '3':
                echo "Becak";
                break;
            case '4':
                echo "Mobil";
                break;
            case '6':
                echo "Truk atau Bus";
                break;
            default:
                echo "Kendaraan tidak diketahui";
            }
        }
        ?>
    </body>
</html>