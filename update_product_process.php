<?php
require './Db/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $Price = $_POST['Price'];
    $availability = $_POST['availability'];

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL update query for product details
        $update_sql = "UPDATE products SET code = :code, name = :name, description = :description, category_id = :category_id, quantity = :quantity, Price = :Price, availability = :availability WHERE id = :id";
        $stmt = $conn->prepare($update_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':Price', $Price, PDO::PARAM_INT);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();

        // Handle new image for the product
        if (!empty($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = './uploads/products/' . $image_name;

            // Move uploaded image
            move_uploaded_file($image_tmp_name, $image_folder);

            // Update image path in the database
            $update_image_sql = "UPDATE products SET image = :image WHERE id = :id";
            $stmt = $conn->prepare($update_image_sql);
            $stmt->bindParam(':image', $image_folder);
            $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Redirect back to the product management page
        $_SESSION['success'] = "Product updated successfully!";
        header('location:index_product.php');
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
        header('location:edit_product.php?id=' . $product_id);
        exit();
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('location:index_product.php');
    exit();
}
