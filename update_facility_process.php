<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $facility_id = $_POST['facility_id'];
    $facility_name = $_POST['facility_name'];
    $description = $_POST['description'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL update query
        $update_sql = "UPDATE facilities SET facility_name = :facility_name, description = :description WHERE facility_id = :id";

        $stmt = $conn->prepare($update_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $facility_id, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Facility updated successfully!';
        header('location:index_facility.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
