<?php
require "koneksi.php";

// Function to get products by category
function getProductsByCategory($conn, $category)
{
    $sql = "SELECT * FROM produk WHERE kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

$selectedCategory = "Jacket"; // Category corresponding to this page

$products = getProductsByCategory($conn, $selectedCategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="katalog.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louvy Store</title>
</head>

<body>
    <h1>Products - Jacket</h1>

    <div class="product-list">
        <?php
        if ($products->num_rows > 0) {
            while ($row = $products->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>Product: " . $row['nama'] . "</h2>";
                echo "Price: " . $row['harga'] . "<br>";
                echo "Category: " . $row['kategori'] . "<br>";
                echo "Image: <img src='upload/" . $row['gambar'] . "' width='150'><br>";

                // Replace the link with a form containing a button
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
            echo "No products in the Jacket category.";
        }
        ?>
    </div>


</body>

</html>