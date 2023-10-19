<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url('backphp.jpeg');
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
            margin: 20px;
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
}

th, td {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    font-family: 'Font-Name', sans-serif;
}

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #4caf50;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #45a049;
        }
.button-ubah {
    background-color: #ffeb3b;
    color: #000;
    padding: 12px 24px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
}

.button-hapus {
    background-color: #ff5252;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
}

.button-ubah:hover {
    background-color: #ffd600;
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255, 235, 59, 0.5);
}

.button-hapus:hover {
    background-color: #ff1a1a;
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255, 82, 82, 0.5);\
}

.button-ubah:active,
.button-hapus:active {
    transform: scale(0.95);
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
}
.menu-link {
    color: #4caf50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.menu-link:hover {
    color: #45a049;
}
.button-kembali {
    background-color: #4caf50;
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.button-kembali:hover {
    background-color: #45a049;
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(76, 175, 80, 0.5);
}

.button-kembali:active {
    transform: scale(0.95);
    box-shadow: none;
    outline: none;
}

    </style>
</head>

<body>
    <div class="container">
        <?php
        require 'koneksi.php';

        $result = mysqli_query($koneksi, "SELECT * FROM produkbuah");

        echo "<h2>Daftar Pesanan</h2>";
        echo "<table>";
        echo "<tr>
        <th>Nama Pemesan</th>
        <th>Alamat</th>
        <th>Buah</th>
        <th>Jumlah</th>
        <th>WhatsApp</th>
        <th>Metode Pembayaran</th>
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
            <td><a class='button-ubah' href='ubah.php?id=" . $row['id_buah'] . "'>Edit</a> | <a class='button-hapus' href='hapus.php?id=" . $row['id_buah'] . "' onclick='return confirmDelete()'>Hapus</a></td>
          </tr>";
        }

        echo "</table>";

        mysqli_free_result($result);

        mysqli_close($koneksi);
        ?>
    </div>
    <div style="margin-top: 20px; text-align: center;">
    <button class="button-kembali" onclick="window.location.href='index.html'">Kembali ke Beranda</button>
</div>

</body>
<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus pesanan ini?");
    }
</script>

</html>