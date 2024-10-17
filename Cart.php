<?php
include_once("./index_Cus.php");
// Include database connection
require_once './Db/connection.php';


// Ensure cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$database = new connection();
$conn = $database->getConnection();

// Function to calculate total bill
function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Add item to cart
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && $product['availability']) {
        // Check if product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // Update quantity if already in cart
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['Price'],
                'quantity' => $quantity,
                'image' => $product['image']
            ];
        }

        $_SESSION['success'] = "Product added to cart!";
    } else {
        $_SESSION['error'] = "Product not available or out of stock.";
    }
}

// Remove item from cart
if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

// Clear entire cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

// Checkout process (this can redirect to a payment page)
if (isset($_POST['checkout'])) {
    header('Location:Payment_process.php');
    exit();
}

// Continue shopping button
if (isset($_POST['continue_shopping'])) {
    header('Location:index_Cus.php');
    exit();
}

// Delivery fees
$delivery_fees = 350;
$total_price = calculateTotal($_SESSION['cart']);
$grand_total = $total_price + $delivery_fees;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./css/cart.Css">
</head>
<body>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <table class="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                    <tr>
                        <td><img src="<?= $item['image'] ?>" alt="Product Image" class="product-image"></td>
                        <td><?= $item['name'] ?></td>
                        <td>Rs. <?= number_format($item['price'], 2) ?></td>
                        <td><input type="number" class="quantity-input" value="<?= $item['quantity'] ?>" min="1" data-product-id="<?= $product_id ?>"></td>
                        <td>Rs. <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                <button type="submit" name="remove" class="btn-remove"  onclick="return confirm('Are you sure you want to remove this item?');">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="cart-summary">
        <p>Delivery Fees: Rs. <?= number_format($delivery_fees, 2) ?></p>
        <p>Total Bill: Rs. <span id="total-bill"><?= number_format($grand_total, 2) ?></span></p>
    </div>

    <div class="cart-actions">
        <form method="POST">
            <button type="submit" name="clear_cart" class="btn btn-clear">Clear Cart</button>
            <button type="submit" name="continue_shopping" class="btn btn-continue">Continue Shopping</button>
            <button type="submit" name="checkout" class="btn btn-checkout">Checkout</button>
        </form>
    </div>
</div>

<script>
    // Update total price dynamically when quantity changes
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.dataset.productId;
            const quantity = parseInt(this.value);
            updateCart(productId, quantity);
        });
    });

    function updateCart(productId, quantity) {
        fetch('update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`,
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-bill').innerText = data.grand_total;
            location.reload();
        });
    }
</script>
<script src="scripts.js"></script>
</body>
</html>

<style>
    body {
        background-image: url("./Images/stuff/cart.jpeg");
        background-size: cover;
        background-position: center;
        color: #000000;
        font-size: 20px;
    }
</style>
