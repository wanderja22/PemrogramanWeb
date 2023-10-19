<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #556b2f;
            margin: 0;
            padding: 0;
            background-image: url('backphp.jpeg');
            background-size: cover;
            background-position: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 50px;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
        
select {
    width: calc(100% - 0px);
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url('arrow-down.png') no-repeat right center;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

select option {
    animation: slideDown 0.5s ease;
}

    </style>
</head>
<body>
<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pemesan = $_POST["nama_pemesan"];
    $alamat_pengiriman = $_POST["alamat_pengiriman"];
    $buah_yang_dipesan = $_POST["buah_yang_dipesan"];
    $jumlah_buah = $_POST["jumlah_buah"];
    $no_whatsapp = $_POST["no_whatsapp"];
    $metode_bayar = $_POST["metode_bayar"];

    $query = "INSERT INTO produkbuah (nama_pemesan, alamat_pengiriman, buah_yang_dipesan, jumlah_buah, no_whatsapp, metode_bayar) VALUES ('$nama_pemesan', '$alamat_pengiriman', '$buah_yang_dipesan', $jumlah_buah, '$no_whatsapp', '$metode_bayar')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="nama">Nama Pemesan :</label>
    <input type="text" id="nama" name="nama_pemesan" required><br>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat_pengiriman" required><br>

    <label for="buah">Pilih Buah:</label>
        <select id="buah" name="buah_yang_dipesan" required>
            <option value="" disabled selected></option>
            <option value="Apel">Apel</option>
            <option value="Jeruk">Jeruk</option>
            <option value="Pisang">Nanas</option>
            <option value="Pisang">Anggur</option>
            <option value="Pisang">Pisang</option>
            <option value="Pisang">Mangga</option>
        </select><br>

    <label for="jumlah">Jumlah:</label>
    <input type="number" id="jumlah" name="jumlah_buah" required><br>

    <label for="whatsapp">Nomor WhatsApp:</label>
    <input type="text" id="whatsapp" name="no_whatsapp" required><br>

    <label for="metode">Metode Pembayaran:</label>
        <select id="metode" name="metode_bayar" required>
            <option value="" disabled selected></option>
            <option value="COD">COD</option>
            <option value="Transfer">Transfer</option>
            <option value="Kredit">Kredit</option>
        </select><br>

    <button type="submit">Tambah Pesanan</button>
</form>
</body>
</html>