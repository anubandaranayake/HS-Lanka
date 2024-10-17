<?php
require './Db/connection.php'; // Include your database connection
session_start();

// Get the category ID from the URL
$category_id = $_GET['id'];

// Create an instance of the connection class
$database = new connection();

try {
    // Establish database connection
    $conn = $database->getConnection();

    // Fetch category details from the database
    $select_sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        $_SESSION['error'] = "Category not found!";
        header('location:index_category.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<?php
include "./admin_side.php"
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php
    include "./admin_nav.php"
    ?>
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Category Management</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Category</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-container">

            <form method="POST" action="./update_category_process.php" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                <div class="input-group">
                    <label for="code">Category Code:</label>
                    <input type="text" name="code" id="code" value="<?php echo $category['code']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="name">Category Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo $category['name']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required><?php echo $category['description']; ?></textarea>
                </div>
                <div class="input-group">
                    <label for="description">Currant image :</label>
                    <img src="<?php echo $category['image']; ?>" alt="Category Image" style="width: 400px; height: 200px; border-radius: 10px; border: 1px solid #ddd; padding: 5px; margin-top: 10px;">
                </div>
                <div class="input-group">
                    <label for="image">New Category Image:</label>
                    <input type="file" name="image" id="image">
                    <!-- Styled image display with inline CSS -->

                </div>

                <button type="submit" name="update_category" class="btn-submit">Update Category</button>
            </form>

        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->


<script src="script.js"></script>
</body>

</html>