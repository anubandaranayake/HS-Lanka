<?php
session_start();

// Update quantity in the session
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }

    // Recalculate total
    $delivery_fees = 350;
    $total_price = array_reduce($_SESSION['cart'], function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    $grand_total = $total_price + $delivery_fees;

    // Return updated total as JSON
    echo json_encode(['grand_total' => 'Rs. ' . number_format($grand_total, 2)]);
}
?>
