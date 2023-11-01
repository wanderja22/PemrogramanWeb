<?php
        require 'koneksi.php';

        date_default_timezone_set('Asia/Jakarta');
        $tanggal_waktu = date('l, d F Y - H:i:s');
        echo "<h2>Daftar Pesanan - $tanggal_waktu</h2>";

        $result = mysqli_query($koneksi, "SELECT * FROM produkbuah");

        echo "<table>";
        echo "<tr>
        <th>Nama Pemesan</th>
        <th>Alamat</th>
        <th>Buah</th>
        <th>Jumlah</th>
        <th>WhatsApp</th>
        <th>Metode Pembayaran</th>
        <th>Bukti Pembayaran</th>
        <th>Aksi</th>
      </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . $row["nama_pemesan"] . "</td>
            <td>" . $row["alamat_pengiriman"] . "</td>
            <td>" . $row["buah_yang_dipesan"] . "</td>
            <td>" . $row["jumlah_buah"] . "</td>
            <td>" . $row["no_whatsapp"] . "</td>
            <td>" . $row["metode_bayar"] . "</td>
            <td><img src='uploads/" . $row["bukti_bayar"] . "' width='100'></td>
            <td>
                <a class='button-ubah' href='ubah.php?id=" . $row['id_buah'] . "'><i class='fa-regular fa-pen-to-square'></i></a> | 
                <a class='button-hapus' href='hapus.php?id=" . $row['id_buah'] . "' onclick='return confirmDelete()'><i class='fa-solid fa-trash'></i></a>
            </td>
          </tr>";
        }

        echo "</table>";

        mysqli_free_result($result);

        mysqli_close($koneksi);
        ?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #171a21;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: #1b2838;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
            margin: 20px;
            width: 80%;
            max-width: 800px;
        }

        h2 {
            background-color: #4caf50;
            color: white;
            padding: 20px;
            margin: 0;
            font-size: 28px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Arial', sans-serif;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #3b444f;
            padding: 15px;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }

        th {
            background-color: #1b2838;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #1b2838;
        }

        a {
            text-decoration: none;
            color: #66c0f4;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #63a69f;
        }

        .button-ubah,
        .button-hapus,
        .button-kembali {
            background-color: #171a21;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .button-ubah:hover,
        .button-hapus:hover,
        .button-kembali:hover {
            background-color: #1b2838;
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .button-ubah:active,
        .button-hapus:active,
        .button-kembali:active {
            transform: scale(0.95);
            box-shadow: none;
            outline: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container"></div>
    <div style="margin-top: 20px; text-align: center;">
        <a class="button-kembali" href="index.html"><i class="fas fa-home"></i> Kembali ke Beranda</a>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus pesanan ini?");
        }
    </script>
</body>

</html>