<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #7D7C7C;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #CCC8AA;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #4caf50;
        }

        p {
            color: #333;
            margin-bottom: 20px;
        }

        strong {
            color: #4caf50;
        }

        .back-button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Terima Kasih!</h1>
        <p>Pesanan Anda telah diterima. Berikut adalah detail pesanan Anda:</p>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['customerName']) && isset($_POST['fruitType']) && isset($_POST['quantity']) && isset($_POST['whatsappNumber'])) {
                $nama = $_POST['customerName'];
                $alamat = $_POST['address'];
                $buah = $_POST['fruitType'];
                $jumlah = $_POST['quantity'];
                $nomorWhatsApp = $_POST['whatsappNumber'];
                $metodePembayaran = $_POST['paymentMethod'];
                echo "<p><strong>Nama Pemesan:</strong> $nama</p>";
                echo "<p><strong>Alamat Pengiriman:</strong> $alamat</p>";
                echo "<p><strong>Buah yang Dipesan:</strong> $buah</p>";
                echo "<p><strong>Jumlah Buah yang Dipesan:</strong> $jumlah</p>";
                echo "<p><strong>Nomor WhatsApp:</strong> $nomorWhatsApp</p>";
                echo "<p><strong>Metode Pembayaran:</strong> $metodePembayaran</p>";
            } else {
                echo "Ada masalah dengan data yang diterima. Harap periksa formulir Anda.";
            }
        } else {
            echo "Metode yang digunakan tidak valid.";
        }
        ?>
        <p>Terima kasih telah berbelanja di Wans Fruits. Tim kami akan segera menghubungi Anda melalui WhatsApp untuk mengatur pengiriman.</p>
        <a href="index.html" class="back-button">Kembali ke Beranda</a>
    </div>
</body>
</html>