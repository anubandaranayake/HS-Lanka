<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL insert query
        $insert_sql = "INSERT INTO services (service_name, description) 
                       VALUES (:service_name, :description)";
        $stmt = $conn->prepare($insert_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':service_name', $service_name);
        $stmt->bindParam(':description', $description);

        // Execute the statement
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Service added successfully!';
        header('location:index_service.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
