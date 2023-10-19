<?php
require 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM produkbuah WHERE id_buah=$id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: error.php");
    exit();
}
?>
