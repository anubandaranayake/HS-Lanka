<?php
require './Db/connection.php'; // Include the database connection file
session_start();

if (isset($_POST['delete_offer'])) {
    // Get the offer ID from the POST data
    $offer_id = $_POST['offer_id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Prepare SQL statement to delete the offer
        $delete_sql = "DELETE FROM offers WHERE offer_id = :offer_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':offer_id', $offer_id);

        // Execute the deletion
        $stmt->execute();

        // Set success message and redirect back to the offer management page
        $_SESSION['success'] = 'Offer deleted successfully';
        header('Location: index_offer.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: manage_offers.php');
    exit();
}
