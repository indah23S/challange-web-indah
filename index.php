<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        @keyframes bling {
            0% { color: #4B0082; }
            50% { color: #8A2BE2; }
            100% { color: #4B0082; }
        }

        body {
            background-color: #f8f9fa; /* Mengubah warna latar belakang menjadi lebih terang */
            color: #343a40; /* Mengubah warna teks menjadi lebih gelap untuk kontras yang lebih baik */
            font-family: "Times New Roman", Times, serif; /* Mengubah font menjadi Times New Roman */
            font-weight: bold; /* Menebalkan font */
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h4 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: bling 1s infinite; /* Menambahkan animasi bling bling ungu gelap */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: linear-gradient(90deg, #50C878, #4B0082); /* Gradasi warna emerald dan ungu gelap */
            color: #495057; /* Warna teks */
        }

        th, td {
            padding: 10px;
            border: 1px solid #dee2e6; /* Menggunakan warna perbatasan standar Bootstrap */
            text-align: center;
        }

        th {
            background-color: #343a40; /* Mengubah warna latar belakang header tabel */
            color: #fff; /* Mengubah warna teks header tabel */
        }

        tr:hover {
            background-color: #f1f1f1; /* Mengubah warna latar belakang saat baris di-hover */
        }

        .btn-primary {
            border-radius: 20px;
            background-color: #006400; /* Mengubah warna tombol Tambahkan Data menjadi emerald gelap */
            border-color: #006400; /* Menyamakan warna border dengan background */
        }

        .btn-secondary, .btn-danger {
            border-radius: 20px;
            background-color: rgba(80, 200, 120, 0.5); /* Mengubah warna tombol menjadi emerald transparan */
            border-color: rgba(80, 200, 120, 0.5); /* Menyamakan warna border dengan background */
        }

        .dropdown {
            text-align: right;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        .menu-krs {
            background-color: #757575;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            display: none;
            margin-bottom: 10px;
        }

        .menu-krs a {
            display: block;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .dropdown:hover .menu-krs {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Tabel Penjualan Barang</h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['kode_barang'])) {
            $kode_barang = htmlspecialchars($_GET["kode_barang"]);
            $sql = "DELETE FROM barang WHERE kode_barang='$kode_barang'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Data Gagal dihapus.</div>";
            }
        }

        $sql = "SELECT * FROM barang ORDER BY kode_barang ASC";
        $hasil = mysqli_query($kon, $sql);

        if (!$hasil) {
            die("Query Error: " . mysqli_error($kon));
        }
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Persediaan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($hasil)) {
                    ?>
                        <tr>
                            <td><?php echo $data["kode_barang"]; ?></td>
                            <td><?php echo $data["nama_barang"]; ?></td>
                            <td><?php echo $data["persediaan"]; ?></td>
                            <td><?php echo $data["harga"]; ?></td>
                            <td><?php echo $data["jumlah"]; ?></td>
                            <td>
                                <a href="update.php?kode_barang=<?php echo htmlspecialchars($data['kode_barang']); ?>" class="btn btn-secondary" role="button">Ubah</a>
                                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?kode_barang=<?php echo $data['kode_barang']; ?>" class="btn btn-danger" role="button" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="create.php" class="btn btn-primary" role="button">Tambahkan Data</a>
    </div>

    <!-- Bootstrap JS bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
