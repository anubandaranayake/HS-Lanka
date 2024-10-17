<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $facility_name = $_POST['facility_name'];
    $description = $_POST['description'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL insert query
        $insert_sql = "INSERT INTO facilities (facility_name, description) 
                       VALUES (:facility_name, :description)";
        $stmt = $conn->prepare($insert_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':facility_name', $facility_name);
        $stmt->bindParam(':description', $description);

        // Execute the statement
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Facility added successfully!';
        header('location:index_facility.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
