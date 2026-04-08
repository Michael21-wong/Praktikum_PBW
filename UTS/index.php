<html>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        header {
            background-color: #0569ff;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 20px;
        }
        .container {
            display: flex;
            width: 100%;
            justify-content: space-between;
            padding: 20px;
        }
        .btn {
            background-color: #0569ff;
            color: rgb(255, 255, 255);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .content {
            width: 50%;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
    </style>
    <head>
        <title>UTS Pemrograman Web</title>
    </head>
    <body>
        <header>
            <h1>Kasir Sederhana</h1>
        </header>
        <div class="container">
        <form action="" method="post">
            <label for="nama">Nama: </label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama anda" required><br><br>
            <label for="NIM">NIM:</label>
            <input type="text" id="NIM" name="NIM" placeholder="Masukkan NIM anda" required maxlength="13"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required><br><br>
            <label for="Layanan">Jenis layanan:</label>
            <select id="Layanan" name="Layanan">
                <option value="reguler">Reguler</option>
                <option value="prioritas">Prioritas</option>
            </select><br><br>
            <h3>Daftar Barang</h3>
            <input type="checkbox" id="barang1" name="barang1" value="Barang 1">
            <label for="barang1">Pulpen</label><br>
            <input type="text" id="jumlah1" name="jumlah1" placeholder="Jumlah Pulpen"><br><br>
            <input type="checkbox" id="barang2" name="barang2" value="Barang 2">
            <label for="barang2">Buku</label><br>
            <input type="text" id="jumlah2" name="jumlah2" placeholder="Jumlah Buku"><br><br>
            <input type="checkbox" id="barang3" name="barang3" value="Barang 3">
            <label for="barang3">Pensil</label><br>
            <input type="text" id="jumlah3" name="jumlah3" placeholder="Jumlah Pensil"><br><br>
            <button class="btn" type="submit" name="Submit" value="Tambahkan">Tambahkan</button>
            </form>
            <section class="content">
                <?php
                define("PAJAK", 0.15);
                $barang = ["Pulpen" => 2000, "Buku" => 5000, "Pensil" => 1000];
                if (isset($_POST['Submit'])) {
                    $nama = $_POST['nama'];
                    $NIM = $_POST['NIM'];
                    $email = $_POST['email'];
                    $Layanan = $_POST['Layanan'];

                    echo "<h3>Data Pembeli</h3>";
                    echo "Nama: $nama <br>";
                    echo "NIM: $NIM <br>";
                    echo "Email: $email <br>";
                    echo "Jenis Layanan: $Layanan <br>";

                    echo "<h3>Barang yang Dibeli</h3>";
                    if (isset($_POST['barang1'])) {
                        $jumlah1 = $_POST['jumlah1'];
                        echo "Pulpen: $jumlah1 <br>";
                    }
                    if (isset($_POST['barang2'])) {
                        $jumlah2 = $_POST['jumlah2'];
                        echo "Buku: $jumlah2 <br>";
                    }
                    if (isset($_POST['barang3'])) {
                        $jumlah3 = $_POST['jumlah3'];
                        echo "Pensil: $jumlah3 <br>";
                    }

                    if (isset($_POST['barang1']) || isset($_POST['barang2']) || isset($_POST['barang3'])) {
                        $total = 0;
                        if (isset($_POST['barang1'])) {
                            $total += $barang["Pulpen"] * $jumlah1;
                        }
                        if (isset($_POST['barang2'])) {
                            $total += $barang["Buku"] * $jumlah2;
                        }
                        if (isset($_POST['barang3'])) {
                            $total += $barang["Pensil"] * $jumlah3;
                        }
                        $pajak = $total * PAJAK;
                        $total_bayar = $total + $pajak;

                        echo "<h3>Perhitungan Harga</h3>";
                        echo "Total Harga (Sebelum Pajak): $total <br>";
                        echo "Pajak (15%): $pajak <br>";
                    } else {
                        echo "<h3>Perhitungan Harga</h3>";
                        echo "Tidak ada barang yang dipilih. <br>";
                    }
                    $biaya_layanan = 0;
                    if ($Layanan == "reguler") {
                        echo "Biaya Layanan: $biaya_layanan <br>";
                    } elseif ($Layanan == "prioritas") {
                        $biaya_layanan = 5000;
                        $total_bayar += $biaya_layanan;
                        echo "Biaya Layanan: $biaya_layanan <br>";
                    }
                    
                        echo "<b>Total Bayar: $total_bayar </b><br>";
                }
                ?>
            </section>
        </div>
    </body>
</html>