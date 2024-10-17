<?php
include "./admin_side.php";
require './Db/connection.php'; // Include the database connection file
session_start();

// Get the product ID from the URL
$product_id = $_GET['id'];

// Create an instance of the connection class
$database = new connection();

try {
    // Establish database connection
    $conn = $database->getConnection();

    // Fetch product details from the database
    $select_sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        $_SESSION['error'] = "Product not found!";
        header('location:index_product.php');
        exit();
    }

    // Fetch categories for the category dropdown
    $select_categories_sql = "SELECT * FROM categories";
    $categories_stmt = $conn->query($select_categories_sql);
    $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    <section id="content">
        <?php include "./admin_nav.php"; ?>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Edit Product</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Edit Product</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
                <form method="POST" action="./update_product_process.php" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="input-group">
                        <label for="code">Product Code:</label>
                        <input type="text" name="code" id="code" value="<?php echo $product['code']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" required><?php echo $product['description']; ?></textarea>
                    </div>

                    <div class="input-group">
                        <label for="category">Category:</label>
                        <select name="category_id" id="category" required>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['id']; ?>" <?php if ($product['category_id'] == $category['id']) echo 'selected'; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="<?php echo $product['quantity']; ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="Price">Price:</label>
                        <input type="number" name="Price" id="Price" value="<?php echo $product['Price']; ?>" required>
                    </div>

                    <div class="input-group">
                        <label for="availability">Availability:</label>
                        <select name="availability" id="availability" required>
                            <option value="1" <?php if ($product['availability'] == 1) echo 'selected'; ?>>Available</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo 'selected'; ?>>Not Available</option>
                        </select>
                    </div>

                    <!-- Display current product image -->
                    <div class="input-group">
                        <label>Current Image:</label>
                        <?php if (!empty($product['image'])) : ?>
                            <div>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="width: 100px; height: 75px; border-radius: 5px; margin-right: 10px;">
                            </div>
                        <?php else : ?>
                            <p>No image found.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Upload New Image -->
                    <div class="input-group">
                        <label for="image">Replace Image:</label>
                        <input type="file" name="image" id="image">
                    </div>

                    <button type="submit" name="update_product" class="btn-submit">Update Product</button>
                </form>
            </div>
        </main>
    </section>
</body>
</html>
