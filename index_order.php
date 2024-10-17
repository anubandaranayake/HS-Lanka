<?php
include_once './admin_side.php';
require_once './Db/connection.php';

session_start();

// Ensure cart exists in the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h2>Your shopping cart is empty.</h2>";
    exit();
}

// Handle item removal from the cart
if (isset($_POST['remove_item']) && isset($_POST['product_id'])) {
    $product_id_to_remove = $_POST['product_id'];

    // Remove the product from the cart session
    if (isset($_SESSION['cart'][$product_id_to_remove])) {
        unset($_SESSION['cart'][$product_id_to_remove]);
        echo "<script>alert('Item removed from cart!');</script>";
    }

    // If the cart is now empty, display a message
    if (empty($_SESSION['cart'])) {
        echo "<h2>Your shopping cart is empty.</h2>";
        exit();
    }
}

// Retrieve the customer username from the session
$customer_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

$delivery_fees = 350; // Set delivery fees (fixed)
$total_price = 0; // Total price starts at zero
?>

<section id="content">
    <!-- NAVBAR -->
    <?php
    include "./admin_nav.php";
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="./css/cart.css">
</head>
<body>

<div class="cart-container">
    <h2>Customer Order</h2>

    <!-- Display customer username -->
    <p><strong>Customer Username:vajira</p>

    <table class="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                <tr>
                    <td><img src="<?= $item['image'] ?>" alt="Product Image" class="product-image"></td>
                    <td><?= $item['name'] ?></td>
                    <td>Rs. <?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rs. <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    <td>
                        <!-- Form to remove item from cart -->
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <button type="submit" name="remove_item" class="btn-remove" onclick="return confirm('Are you sure you want to remove this item?');">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php 
                // Calculate the total price of the cart items
                $total_price += $item['price'] * $item['quantity'];
                ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="cart-summary">
        <p>Subtotal: Rs. <?= number_format($total_price, 2) ?></p>
        <p>Delivery Fees: Rs. <?= number_format($delivery_fees, 2) ?></p>
        <p>Total Bill: Rs. <?= number_format($total_price + $delivery_fees, 2) ?></p>
    </div>

    <div class="cart-actions">
        <!-- Order status selection -->
        <form method="POST" action="update_order_status.php">
            <label for="order-status">Select Order Status:</label>
            <select name="order_status" id="order-status">
                <option value="order_processing">Order Processing</option>
                <option value="shipped">Shipped</option>
            </select>
            <br><br>
            <button type="submit" name="update_status" class="btn btn-update" onclick="alert('Updated!');">Update Status</button>
        </form>
    </div>
</div>

</body>
</html>

<style>
    .cart-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .cart-table, .cart-table th, .cart-table td {
        border: 1px solid #ddd;
        padding: 10px;
    }
    .cart-table th, .cart-table td {
        text-align: center;
    }
    .product-image {
        width: 80px;
        height: auto;
    }
    .btn-remove, .btn-checkout {
        padding: 8px 12px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin: 5px;
    }
    .btn-remove:hover, .btn-checkout:hover {
        background-color: #0056b3;
    }
    .cart-summary {
        margin-top: 20px;
        text-align: right;
    }
    .cart-actions {
        text-align: center;
        margin-top: 20px;
    }
    #order-status {
        padding: 8px;
        margin: 10px 0;
    }

    .body {
        background-image: url(".//Images/stuff/bg7.jpg");
        background-size: cover;
        background-position: center;
        color: #000000;
        font-size: 20px;
    }
</style>
