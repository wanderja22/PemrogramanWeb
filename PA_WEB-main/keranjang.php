<?php
require "koneksi.php";

// Fungsi untuk mengambil data keranjang
function getCartItems($conn) {
    $sql = "SELECT * FROM keranjang";
    $result = $conn->query($sql);
    return $result;
}

// Handle "Add to Cart" action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    
    // Insert the product into the cart
    $stmt = $conn->prepare("INSERT INTO keranjang (nama, harga, gambar) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $product_name, $product_price, $product_image);
    
    if ($stmt->execute()) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error adding product to cart: " . $stmt->error;
    }
    
    $stmt->close();
}

// Ambil data keranjang
$cartItems = getCartItems($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>

<body>
    <div style="text-align: left; padding: 10px;">
        <a href="index.php"><img src="path/to/your/back-icon.png" alt="Back" width="30"></a>
    </div>

    <h1>Keranjang Belanja</h1>

    <div class="cart-list">
        <?php
        if ($cartItems->num_rows > 0) {
            while ($item = $cartItems->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<h3>Produk: " . $item['nama'] . "</h3>";
                echo "Harga: " . $item['harga'] . "<br>";
                echo "Gambar: <img src='upload/" . $item['gambar'] . "' width='100'><br>";

                // Tombol Hapus
                echo "<form action='hapusitem.php' method='post'>";
                echo "<input type='hidden' name='item_id' value='" . $item['id'] . "'>";
                echo "<button type='submit' name='remove_from_cart'>Hapus</button>";
                echo "</form>";

                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "Keranjang belanja Anda kosong.";
        }
        ?>
    </div>
</body>

</html>