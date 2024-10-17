<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];

    $database = new connection();

    try {
        $conn = $database->getConnection();

        // Prepare SQL delete query
        $delete_sql = "DELETE FROM services WHERE service_id = :id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':id', $service_id, PDO::PARAM_INT);

        // Execute the delete query
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Service deleted successfully!';
        header('location:index_service.php');
        exit();

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
