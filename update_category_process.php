<?php
require './Db/connection.php'; // Include your database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $category_id = $_POST['category_id'];
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

        // Prepare SQL update query
        $update_sql = "UPDATE categories SET code = :code, name = :name, description = :description";
        
        // Check if a new image was uploaded
        if ($image) {
            $update_sql .= ", image = :image"; // Update image field if a new image is uploaded
            move_uploaded_file($image_tmp_name, $image_folder); // Move the uploaded file to the folder
        }

        $update_sql .= " WHERE id = :id";

        $stmt = $conn->prepare($update_sql);

        // Bind the parameters to the query
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        if ($image) {
            $stmt->bindParam(':image', $image_folder);
        }
        $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

        // Execute the update query
        $stmt->execute();

        // Success message
        $_SESSION['success'] = 'Category updated successfully!';
        header('location:index_category.php');
        exit();

    } catch (PDOException $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
}
?>
