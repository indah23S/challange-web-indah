<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            background-color: rgba(169, 169, 169, 0.5); /* abu-abu transparan */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        @keyframes blinking {
            0% { color: #2e8b57; }
            50% { color: #ffffff; }
            100% { color: #2e8b57; }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            animation: blinking 1s infinite;
        }

        label {
            font-weight: bold;
            color: #2e8b57; /* emerald gelap */
        }

        input[type="text"] {
            border-radius: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
            border-radius: 20px;
            background-color: #2e8b57; /* emerald gelap */
            border-color: #2e8b57; /* emerald gelap */
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-family: 'Times New Roman', Times, serif;
        }

        .btn-primary:hover {
            background-color: #276846; /* lebih gelap untuk hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>INPUT DATA BARANG</h2>
        <?php
        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode_barang = input($_POST["kode_barang"]);
            $nama_barang = input($_POST["nama_barang"]);
            $persediaan = input($_POST["persediaan"]);
            $harga = input($_POST["harga"]);
            $jumlah = input($_POST["jumlah"]);

            $sql = "INSERT INTO barang (kode_barang, nama_barang, persediaan, harga, jumlah) VALUES ('$kode_barang', '$nama_barang', '$persediaan', '$harga', '$jumlah')";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
            }
        }
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group">
                <label for="kode_barang">Kode Barang:</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan kode barang" required />
            </div>
            <div class="form-group">
                <label for="barang">Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required />
            </div>
            <div class="form-group">
                <label for="persediaan">Persediaan:</label>
                <input type="text" name="persediaan" class="form-control" placeholder="Masukkan persediaan" required />
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" name="harga" class="form-control" placeholder="Masukkan harga" required />
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="text" name="jumlah" class="form-control" placeholder="Masukkan jumlah" required />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Selesai</button>
        </form>
    </div>
</body>
</html>
