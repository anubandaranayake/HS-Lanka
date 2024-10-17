<?php
// Start session for storing success message
session_start();

// Include the connection file
include_once './/Db/connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new connection instance
    $database = new connection();
    $db = $database->getConnection();

    // Here you would typically process the form data and save it to the database
    // For demonstration, we'll just set a session variable
    $_SESSION['order_success'] = true;

    // Redirect to thank you page
    header("Location: thank_you.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href=".//css/payment.Css"> <!-- External CSS -->
</head>
<body>
    <div class="container">
        <div class="form-container left">
            <h2>Customer Details</h2>
            <form method="post">
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country" required>
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">UK</option>
                        <option value="Sri Lanka">Sri Lanka</option>

                        <!-- Add more countries as needed -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="address1">Address Line 1:</label>
                    <input type="text" id="address1" name="address1" required>
                </div>
                <div class="form-group">
                    <label for="address2">Address Line 2:</label>
                    <input type="text" id="address2" name="address2">
                </div>
                <div class="form-group">
                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code:</label>
                    <input type="text" id="postal_code" name="postal_code" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
        </div>

        <div class="form-container right">
            <h2>Payment Information</h2>
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="card">Card Payment</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number">
            </div>
            <div class="form-group">
                <label for="card_holder_name">Card Holder Name:</label>
                <input type="text" id="card_holder_name" name="card_holder_name">
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date (dd/mm/yy):</label>
                <input type="text" id="expiry_date" name="expiry_date">
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv">
            </div >
            </form>
        </div>
    </div>
</div>
<br><br><br>
    <div class="placeorder">
    <a href="thank_you.php" class="btn-submit">Place Order</a>
    </div>
</body>
</html>
<style>
    body{
        background-image:url(.//Images/stuff/payment.jpg) ;
        background-size: auto;
    background-position: 0;
    color: #333;
        
    }
</style>