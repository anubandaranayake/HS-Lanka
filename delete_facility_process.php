<?php
require './Db/connection.php'; // Include your database connection
session_start();

if (isset($_POST['delete_facility'])) {
    $facility_id = $_POST['facility_id'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL delete query
        $delete_sql = "DELETE FROM facilities WHERE facility_ID = :facility_id";
        $stmt = $conn->prepare($delete_sql);

        // Bind the parameter
        $stmt->bindParam(':facility_id', $facility_id);

        // Execute the statement
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Facility deleted successfully!';
        header('location:index_facility.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
