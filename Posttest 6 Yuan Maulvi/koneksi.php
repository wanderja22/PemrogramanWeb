<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "tokobuah";

$koneksi = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

?>
