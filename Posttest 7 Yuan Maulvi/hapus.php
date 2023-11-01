<?php
require 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $query_select = "SELECT bukti_bayar FROM produkbuah WHERE id_buah=$id";
    $result = mysqli_query($koneksi, $query_select);
    $row = mysqli_fetch_assoc($result);
    $nama_file = $row['bukti_bayar'];

    $file_path = __DIR__ . '/uploads/' . $nama_file;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    $query_delete = "DELETE FROM produkbuah WHERE id_buah=$id";
    if (mysqli_query($koneksi, $query_delete)) {
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query_delete . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: error.php");
    exit();
}
?>