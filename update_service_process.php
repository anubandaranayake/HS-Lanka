<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL update query
        $update_sql = "UPDATE services SET service_name = :service_name, description = :description WHERE service_id = :service_id";
        $stmt = $conn->prepare($update_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':service_name', $service_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Service updated successfully!';
        header('location:index_service.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
