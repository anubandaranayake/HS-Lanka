<?php
require './Db/connection.php'; // Include the database connection file
session_start();

if (isset($_POST['delete_product'])) {
    // Get the product ID from the POST data
    $product_id = $_POST['product_id'];

    // Create an instance of the Database connection class
    $database = new connection();
    $conn = $database->getConnection();

    try {
        // Begin a transaction
        $conn->beginTransaction();

        // Prepare SQL statement to get the image path associated with the product
        $select_image_sql = "SELECT image FROM products WHERE id = :product_id";
        $stmt = $conn->prepare($select_image_sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Delete image from the file system
        if ($product && file_exists($product['image'])) {
            unlink($product['image']); // Delete image file from the server
        }

        // Prepare SQL statement to delete the product
        $delete_product_sql = "DELETE FROM products WHERE id = :product_id";
        $stmt = $conn->prepare($delete_product_sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Set success message and redirect back to the product management page
        $_SESSION['success'] = 'Product deleted successfully';
        header('Location: index_product.php');
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction in case of error
        $conn->rollBack();

        // Set error message and redirect back to product management page
        $_SESSION['error'] = 'Error deleting product: ' . $e->getMessage();
        header('Location: manage_products.php');
        exit();
    }
} else {
    // Redirect to prevent direct access to this script
    header('Location: manage_products.php');
    exit();
}
?>
