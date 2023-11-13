<?php
require "koneksi.php";

// Fungsi untuk mengambil produk berdasarkan kategori
function getProductsByCategory($conn, $category) {
    $sql = "SELECT * FROM produk WHERE kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

$selectedCategory = "Shoes"; // Kategori yang sesuai dengan halaman ini

$products = getProductsByCategory($conn, $selectedCategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Shoes</title>
</head>

<body>
    <h1>Produk Shoes</h1>

    <div class="product-list">
        <?php
        if ($products->num_rows > 0) {
            while ($row = $products->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>Produk: " . $row['nama'] . "</h2>";
                echo "Harga: " . $row['harga'] . "<br>";
                echo "Kategori: " . $row['kategori'] . "<br>";
                echo "Gambar: <img src='upload/" . $row['gambar'] . "' width='150'><br>";

                // Tambahkan form untuk menambahkan produk ke keranjang
                echo "<form action='keranjang.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                echo "<input type='hidden' name='product_name' value='" . $row['nama'] . "'>";
                echo "<input type='hidden' name='product_price' value='" . $row['harga'] . "'>";
                echo "<input type='hidden' name='product_image' value='" . $row['gambar'] . "'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";

                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "Tidak ada produk dalam kategori Shoes.";
        }
        ?>
    </div>
</body>

</html>
