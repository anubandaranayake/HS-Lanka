<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $code = $_POST['code'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = './uploads/categories/' . $image;

    // Create an instance of the connection class
    $database = new connection();

    try {
        // Establish database connection
        $conn = $database->getConnection();

        // Prepare SQL insert query
        $insert_sql = "INSERT INTO categories (code, name, image, description) 
                       VALUES (:code, :name, :image, :description)";
        $stmt = $conn->prepare($insert_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image_folder); // Store image path in DB
        $stmt->bindParam(':description', $description);

        // Move uploaded image to the designated folder
        move_uploaded_file($image_tmp_name, $image_folder);

        // Execute the statement
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Category added successfully!';
        header('location:index_category.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
