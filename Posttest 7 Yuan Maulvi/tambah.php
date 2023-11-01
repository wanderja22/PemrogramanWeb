<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pemesan = $_POST["nama_pemesan"];
    $alamat_pengiriman = $_POST["alamat_pengiriman"];
    $buah_yang_dipesan = $_POST["buah_yang_dipesan"];
    $jumlah_buah = $_POST["jumlah_buah"];
    $no_whatsapp = $_POST["no_whatsapp"];
    $metode_bayar = $_POST["metode_bayar"];

    $nama_file = $_FILES['bukti_bayar']['name'];    
    $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);

    $tanggal_sekarang = date("Y-m-d");
    $nama_file_baru = $tanggal_sekarang . " " . basename($nama_file, "." . $ekstensi_file) . "." . $ekstensi_file;

    $upload_dir = __DIR__ . '/uploads/';
    $lokasi_file = $_FILES['bukti_bayar']['tmp_name'];
    $lokasi_upload = $upload_dir . $nama_file_baru;

    if (move_uploaded_file($lokasi_file, $lokasi_upload)) {
        $query = "INSERT INTO produkbuah (nama_pemesan, alamat_pengiriman, buah_yang_dipesan, jumlah_buah, no_whatsapp, metode_bayar, bukti_bayar) VALUES ('$nama_pemesan', '$alamat_pengiriman', '$buah_yang_dipesan', $jumlah_buah, '$no_whatsapp', '$metode_bayar', '$nama_file_baru')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: tampil.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Upload bukti pembayaran gagal.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #171a21;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #1b2838;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }


        input[type="text"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 15px;
            font-size: 16px;
            border: 2px solid #3f87f5;
            border-radius: 10px;
            box-sizing: border-box;
            margin-bottom: 20px;
            background-color: #1b2838;
            color: white;
        }

        button {
            background-color: #3f87f5;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        label {
            text-align: center ;
            display: block;
            margin-bottom: 10px;
        }


        button:hover {
            background-color: #305f8c;
        }

        input[type="file"],
        button[type="submit"] {
            width: calc(100% - 20px);
            padding: 15px;
            font-size: 16px;
            border: 2px solid #3f87f5;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #1b2838;
            color: white;
            box-sizing: border-box;
        }

        select {
            width: calc(100% - 20px);
            padding: 15px;
            font-size: 16px;
            border: 2px solid #3f87f5;
            border-radius: 5px;
            background-color: #1b2838;
            color: white;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            border: 2px solid black;
            background-color: #3f87f5;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-bottom: 30px;
        }

        button[type="submit"]:hover {
            background-color: black;
        }
        
        a {
            background-color: #3f87f5;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
            border: 2px solid black;
        }

        a:hover {
            background-color: black;
        }
    </style>
</head>
<body>

<div class="container">
        <h2>Tambah Pesanan</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <input type="text" id="nama" name="nama_pemesan" placeholder="Nama Pemesan" autocomplete='off' required><br>
            <input type="text" id="alamat" name="alamat_pengiriman" placeholder="Alamat" autocomplete='off' required><br>
            <select id="buah" name="buah_yang_dipesan" required>
                <option value="" disabled selected>Pilih Buah</option>
                <option value="Apel">Apel</option>
                <option value="Jeruk">Jeruk</option>
                <option value="Pisang">Pisang</option>
                <option value="Pisang">Nanas</option>
                <option value="Pisang">Anggur</option>
                <option value="Pisang">Mangga</option>
            </select><br>
            <input type="number" id="jumlah" name="jumlah_buah" placeholder="Jumlah" required><br>
            <input type="text" id="whatsapp" name="no_whatsapp" placeholder="Nomor WhatsApp" autocomplete='off' required><br>
            <select id="metode" name="metode_bayar" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="COD">COD</option>
                <option value="Transfer">Transfer</option>
                <option value="Kredit">Kredit</option>
            </select><br>
            <label for="bukti_bayar">Bukti Pembayaran</label>
            <input type="file" id="bukti_bayar" name="bukti_bayar" accept="image/*" required><br>
            <button type="submit">Tambah Pesanan</button>
            <a class="login-link" href="logout.php">logout</a>
        </form>
    </div>
</body>
</html>