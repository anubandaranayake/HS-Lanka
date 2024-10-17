<?php
include "./admin_side.php";
require './Db/connection.php'; // Include the database connection file
session_start();
$database = new connection();

try {
    // Get the database connection
    $conn = $database->getConnection();

    // Query to fetch categories from the 'categories' table
    $select_sql = "SELECT * FROM categories";
    $stmt = $conn->query($select_sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all categories
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php
    include "./admin_nav.php"
    ?>

    <!-- MAIN -->
    <main>
        <!-- Success message -->
        <div class="alert">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']); // Clear the success message after displaying
            }
            ?>
        </div>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
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
            <a href="./add_category.php" class="btn-download">
                <li><i class='bx bx-plus'></i></li>
                <span class="text">Add Category</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Category Management</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>



                <!-- Category table -->
                <table>
                    <thead>
                        <tr>
                           <th>Category Id</th>
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?php echo $category['id']; ?></td>
                                    <td><?php echo $category['code']; ?></td>
                                    <td><?php echo $category['name']; ?></td>
                                    <td>
    <img src="<?php echo $category['image']; ?>" alt="Category Image" style="border-radius: 1px; width: 100px; height: 75px;">
</td>


                                    <td><?php echo $category['description']; ?></td>
                                    <td>
                                        <!-- Edit and Delete buttons with icons -->
                                        <form method="POST" action="./delete_category_process.php" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display:inline-block;">
                                            <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                            <button type="submit" name="delete_category" style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-trash" style="color:red; font-size:16px;"></i> <!-- Delete Icon -->
                                            </button>
                                        </form>

                                        <a href="edit_category.php?id=<?php echo $category['id']; ?>" style="text-decoration:none; margin-left:10px;">
                                            <button style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-edit" style="color:green; font-size:16px;"></i> <!-- Edit Icon -->
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>

</html>