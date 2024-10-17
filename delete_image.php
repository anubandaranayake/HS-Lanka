<?php
require './Db/connection.php'; // Include your database connection
session_start();

if (isset($_GET['image_id']) && isset($_GET['product_id'])) {
    $image_id = $_GET['image_id'];
    $product_id = $_GET['product_id'];

    $database = new connection();
    try {
        $conn = $database->getConnection();

        // Fetch image path from the database
        $select_sql = "SELECT image_path FROM product_images WHERE id = :image_id";
        $stmt = $conn->prepare($select_sql);
        $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            // Delete the image file from the server
            unlink($image['image_path']);

            // Delete the image record from the database
            $delete_sql = "DELETE FROM product_images WHERE id = :image_id";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        $_SESSION['success'] = 'Image deleted successfully!';
        header('Location: edit_product.php?id=' . $product_id);
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: index_product.php');
    exit();
}
?>
