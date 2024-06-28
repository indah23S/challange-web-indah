<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Times New Roman', Times, serif;
        }

        .container {
            margin-top: 50px;
            background-color: rgba(169, 169, 169, 0.5); /* abu-abu transparan */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            font-weight: bold;
        }

        @keyframes bling-bling {
            0% { color: #2e8b57; } /* warna awal */
            50% { color: #FFFFFF; } /* warna tengah (misalnya warna putih) */
            100% { color: #2e8b57; } /* kembali ke warna awal */
        }

        h2 {
            text-align: center;
            color: #2e8b57; /* emerald gelap */
            margin-bottom: 30px;
            font-weight: bold;
            animation: bling-bling 2s ease-in-out infinite; /* animasi berkelanjutan selama 2 detik */
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
        <?php
        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $kode_barang=input($_POST["kode_barang"]);
            $nama_barang=input($_POST["nama_barang"]);
            $persediaan=input($_POST["persediaan"]);
            $harga=input($_POST["harga"]);
            $jumlah=htmlspecialchars($_POST["jumlah"]);

            $sql="UPDATE barang SET
                nama_barang='$nama_barang',
                persediaan='$persediaan',
                harga='$harga',
                jumlah='$jumlah'
                WHERE kode_barang=$kode_barang";

            $hasil=mysqli_query($kon,$sql);

            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

            }

        }

        if (isset($_GET['kode_barang'])) {
            $kode_barang=input($_GET["kode_barang"]);

            $sql="SELECT * FROM barang WHERE kode_barang=$kode_barang";
            $hasil=mysqli_query($kon,$sql);
            $data = mysqli_fetch_assoc($hasil);
        }
        ?>
        <h2>UBAH DATA</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Kode Barang:</label>
                <input type="text" name="kode_barang" class="form-control" value="<?php echo $data['kode_barang']; ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" value="<?php echo $data['nama_barang']; ?>" required />
            </div>
            <div class="form-group">
                <label>Persediaan:</label>
                <input type="text" name="persediaan" class="form-control" placeholder="Masukkan persediaan" value="<?php echo $data['persediaan']; ?>" required />
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="text" name="harga" class="form-control" placeholder="Masukkan harga" value="<?php echo $data['harga']; ?>" required />
            </div>
            <div class="form-group">
                <label>Jumlah:</label>
                <input type="text" name="jumlah" class="form-control" placeholder="Masukkan jumlah" value="<?php echo $data['jumlah']; ?>" required />
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Selesai</button>
        </form>
    </div>
</body>
</html>
