<?php
session_start();

// Check if the product ID is set and remove it from the wishlist
if (isset($_POST['product_id']) && isset($_SESSION['wishlist'])) {
    $productIdToRemove = $_POST['product_id'];

    // Loop through the wishlist and remove the item
    foreach ($_SESSION['wishlist'] as $key => $item) {
        if ($item['product_id'] == $productIdToRemove) {
            // Remove the item from the wishlist
            unset($_SESSION['wishlist'][$key]);
            break; // Exit the loop after removing the item
        }
    }

    // Optional: Re-index the array to ensure there are no gaps in keys
    $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
}

// Redirect back to the wishlist or product list page
header('Location: .//Wishlist.php'); // Change this to your actual wishlist page
exit;
?>
