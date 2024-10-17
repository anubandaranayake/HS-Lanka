<?php
require './Db/connection.php'; // Include the database connection file
session_start();

if (isset($_POST['delete_category'])) {
    // Get the category ID from the POST data
    $category_id = $_POST['category_id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Prepare SQL statement to delete the category
        $delete_sql = "DELETE FROM categories WHERE id = :category_id";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':category_id', $category_id);

        // Execute the deletion
        $stmt->execute();

        // Set success message and redirect back to the category management page
        $_SESSION['success'] = 'Category deleted successfully';
        header('Location: index_category.php');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error: ' . $e->getMessage();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: manage_categories.php');
    exit();
}
