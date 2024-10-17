<?php
include "./index_Cus.php"; // Change this to include the customer side
require_once './Db/connection.php'; 

$database = new connection();

try {
    $conn = $database->getConnection();

    // Modified SQL to use the new 'products' table schema
    $select_sql = "
        SELECT p.id AS product_id, p.code, p.name, p.description, p.quantity, p.Price, p.availability, 
               c.name AS category_name, 
               p.image AS product_image
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE c.name = 'Home and Living'  -- Filter for Home and Living category
    ";
    $stmt = $conn->query($select_sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <main>
        <div class="alert">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']); 
            }
            ?>
        </div>
        <div class="head-title">
            <div class="left">
                <h1>Home and Living Products</h1>
                <ul class="breadcrumb">
                    <li><i class='bx bx-chevron-right'></i></li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Product List</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Product Images</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['category_name']; ?></td>
                                    <td><?php echo number_format($product['Price'], 2); ?></td>
                                    <td>
                                        <form method="POST" action="./Cart.php">
                                            <input type="number" name="quantity" value="1" min="1" style="width: 50px;" id="quantity_<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    </td>
                                    <td>
                                        <img src="<?php echo $product['product_image']; ?>" alt="Product Image" class="product-image">
                                    </td>
                                    <td>
                                        <!-- Cart Button -->
                                        <button type="submit" name="add_to_cart" class="cart-button" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['Price']; ?>); return false;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        </form>

                                        <!-- Wishlist Button -->
                                        <form method="POST" action="./Wishlist.php" style="display:inline-block;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo addslashes($product['name']); ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $product['Price']; ?>">
                                            <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>">
                                            <button type="submit" name="add_to_wishlist" class="wishlist-button" onclick="alert('Item added to wishlist!');">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>
<script>
    function addToCart(productId, name, price) {
        var quantity = document.getElementById('quantity_' + productId).value;

        // Use Fetch API to send the data to Cart.php without refreshing the page
        fetch('./Cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + productId + '&quantity=' + quantity
        })
        .then(response => {
            if (response.ok) {
                alert('Item added to cart!');
                // Optionally, you can redirect the user to the cart page or update the cart UI.
                window.location.href = './Cart.php'; // Redirect to the cart page
            } else {
                alert('Failed to add item to cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
<script src="script.js"></script>
</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    #content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .head-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .head-title h1 {
        font-size: 24px;
        color: #333;
    }

    .breadcrumb {
        list-style: none;
        padding: 0;
    }

    .breadcrumb li {
        display: inline;
        margin-right: 5px;
    }

    .breadcrumb li i {
        font-size: 12px;
    }

    .table-data {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .table-data .order {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .product-image {
        width: 100px;
        height: 75px;
        border-radius: 5px;
    }

    .cart-button, .wishlist-button {
        border: none;
        background: none;
        cursor: pointer;
        color: #007bff;
        font-size: 18px;
    }

    .cart-button:hover, .wishlist-button:hover {
        color: #0056b3;
    }
</style>
