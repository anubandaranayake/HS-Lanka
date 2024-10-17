<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $offer_id = $_POST['offer_id'];
    $offer_name = $_POST['offer_name'];
    $description = $_POST['description'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL update query
        $update_sql = "UPDATE offers SET offer_name = :offer_name, description = :description WHERE offer_id = :id";

        $stmt = $conn->prepare($update_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':offer_name', $offer_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $offer_id, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Offer updated successfully!';
        header('location:index_offer.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
