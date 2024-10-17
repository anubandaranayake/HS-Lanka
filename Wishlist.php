<?php
include_once("./index_cus.php");
require './Db/connection.php'; 

$database = new connection();

try {
    $conn = $database->getConnection();
    
    // Check if item is being added to wishlist
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
        // Store product information in session
        $_SESSION['wishlist'][] = [
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],  // Ensure this is a decimal value
            'product_image' => $_POST['product_image']
        ];
        // Redirect back to product list or display a success message
        header('Location: ./Wishlist.php'); // Adjust to your actual page
        exit;
    }

    // Initialize wishlist items from session
    $wishlist_items = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];

    // Check if item is being added to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        // Store product information in session cart
        $_SESSION['cart'][] = [
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image']
        ];
        // Redirect back to wishlist or display a success message
        header('Location: ./Wishlist.php'); // Adjust to your actual page
        exit;
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href=".//css/wishlist.Css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
</head>
<body>

<div class="wishlist-container">
    <h2>Your Wishlist</h2>

    <?php if (count($wishlist_items) > 0) { ?>
        <table class="wishlist-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($wishlist_items as $item) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['product_price']); ?></td>
                        <td>
                            <form method="post" action="remove_wishlist.php" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                <button type="submit" name="remove_wishlist" class="remove-btn">Remove</button>
                            </form>
                            <form method="post" action="" style="display: inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($item['product_name']); ?>">
                                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($item['product_price']); ?>">
                                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($item['product_image']); ?>">
                                <button type="submit" name="add_to_cart" class="add-to-cart-btn" title="Add to Cart" onclick="alert('Item added to Cart!');">
                                    <i class="fas fa-shopping-cart"></i> <!-- Cart icon -->
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Your wishlist is empty.</p>
    <?php } ?>
</div>

</body>
</html>
<style>
    body {
        background-image: url(".//Images/stuff/bg7.jpg");
    }
    .add-to-cart-btn, .remove-btn {
        margin-left: 5px; /* Add space between buttons */
        background: none; /* Remove default button styling */
        border: none; /* Remove border */
        color: #007bff; /* Set color for the icon */
        cursor: pointer; /* Pointer cursor for better UX */
    }
    .add-to-cart-btn i {
        font-size: 1.2em; /* Increase the size of the icon */
    }
</style>
