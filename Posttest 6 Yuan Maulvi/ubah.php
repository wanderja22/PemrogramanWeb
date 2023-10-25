<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #556b2f;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('Image/backphp.jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #4caf50;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            font-size: 18px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 40px);
            padding: 15px;
            font-size: 16px;
            border: 5px solid #ccc;
            border-radius: 5px;
            margin-right: 20px;
        }

        .form-group button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .form-group button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    require 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nama_pemesan = $_POST["nama_pemesan"];
        $alamat_pengiriman = $_POST["alamat_pengiriman"];
        $buah_yang_dipesan = $_POST["buah_yang_dipesan"];
        $jumlah_buah = $_POST["jumlah_buah"];
        $no_whatsapp = $_POST["no_whatsapp"];
        $metode_bayar = $_POST["metode_bayar"];

        $queryGetFileName = "SELECT bukti_bayar FROM produkbuah WHERE id_buah=$id";
        $resultFileName = mysqli_query($koneksi, $queryGetFileName);
        $rowFileName = mysqli_fetch_assoc($resultFileName);
        $nama_file_lama = $rowFileName['bukti_bayar'];

        if ($_FILES['bukti_bayar']['name']) {
            $nama_file_baru = $_FILES['bukti_bayar']['name'];
            $ekstensi_file = pathinfo($nama_file_baru, PATHINFO_EXTENSION);

            $tanggal_sekarang = date("Y-m-d");
            $nama_file_baru = $tanggal_sekarang . " " . basename($nama_file_baru, "." . $ekstensi_file) . "." . $ekstensi_file;

            $lokasi_file = $_FILES['bukti_bayar']['tmp_name'];

            $upload_dir = __DIR__ . '/uploads/';
            $lokasi_upload = $upload_dir . $nama_file_baru;

            if (move_uploaded_file($lokasi_file, $lokasi_upload)) {
                if ($nama_file_lama != "" && file_exists($upload_dir . $nama_file_lama)) {
                    unlink($upload_dir . $nama_file_lama);
                }
            } else {
                echo "Upload bukti pembayaran gagal.";
                exit();
            }
        } else {
            $nama_file_baru = $nama_file_lama;
        }

        $query = "UPDATE produkbuah SET nama_pemesan='$nama_pemesan', alamat_pengiriman='$alamat_pengiriman', buah_yang_dipesan='$buah_yang_dipesan', jumlah_buah=$jumlah_buah, no_whatsapp='$no_whatsapp', metode_bayar='$metode_bayar', bukti_bayar='$nama_file_baru' WHERE id_buah=$id";

        if (mysqli_query($koneksi, $query)) {
            header("Location: tampil.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    }
    ?>

    <div class="container">
        <h2>Ubah Pesanan</h2>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM produkbuah WHERE id_buah=$id";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_pemesan">Nama Pemesan:</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?php echo $row['nama_pemesan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat_pengiriman">Alamat Pengiriman:</label>
                <input type="text" id="alamat_pengiriman" name="alamat_pengiriman" value="<?php echo $row['alamat_pengiriman']; ?>" required>
            </div>
            <div class="form-group">
                <label for="buah_yang_dipesan">Pilih Buah:</label>
                <select id="buah_yang_dipesan" name="buah_yang_dipesan" required>
                    <option value="Apel" <?php if ($row['buah_yang_dipesan'] == 'Apel') echo 'selected'; ?>>Apel</option>
                    <option value="Jeruk" <?php if ($row['buah_yang_dipesan'] == 'Jeruk') echo 'selected'; ?>>Jeruk</option>
                    <option value="Nanas" <?php if ($row['buah_yang_dipesan'] == 'Nanas') echo 'selected'; ?>>Nanas</option>
                    <option value="Anggur" <?php if ($row['buah_yang_dipesan'] == 'Anggur') echo 'selected'; ?>>Anggur</option>
                    <option value="Pisang" <?php if ($row['buah_yang_dipesan'] == 'Pisang') echo 'selected'; ?>>Pisang</option>
                    <option value="Mangga" <?php if ($row['buah_yang_dipesan'] == 'Mangga') echo 'selected'; ?>>Mangga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_buah">Jumlah Buah:</label>
                <input type="number" id="jumlah_buah" name="jumlah_buah" value="<?php echo $row['jumlah_buah']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_whatsapp">Nomor WhatsApp:</label>
                <input type="text" id="no_whatsapp" name="no_whatsapp" value="<?php echo $row['no_whatsapp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="metode_bayar">Metode Pembayaran:</label>
                <select id="metode_bayar" name="metode_bayar" required>
                    <option value="COD" <?php if ($row['metode_bayar'] == 'COD') echo 'selected'; ?>>COD</option>
                    <option value="Transfer" <?php if ($row['metode_bayar'] == 'Transfer') echo 'selected'; ?>>Transfer</option>
                    <option value="Kredit" <?php if ($row['metode_bayar'] == 'Kredit') echo 'selected'; ?>>Kredit</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bukti_bayar">Bukti Pembayaran:</label>
                <input type="file" id="bukti_bayar" name="bukti_bayar" accept="image/*">
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id_buah']; ?>">
            <div class="form-group">
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>

</html>