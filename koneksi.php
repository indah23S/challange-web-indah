<?php
$host = "localhost"; // biasanya 'localhost'
$username = "root"; // biasanya 'root' untuk XAMPP
$password = ""; // biasanya kosong untuk XAMPP
$database = "penjualanbarang"; // ganti dengan nama database Anda

$kon = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
