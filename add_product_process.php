<?php
include "./admin_side.php";
require './Db/connection.php'; 
session_start();
?>

<!-- CONTENT -->
<section id="content">
    <?php include "./admin_nav.php"; ?>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Product Management</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Add Product</a></li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form action="./add_product_process.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" required>
                </div>
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <div class="input-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" required>
                </div>
                <div class="input-group">
                    <label for="Price">Price</label>
                    <input type="number" step="0.01" name="Price" id="Price" required>
                </div>
                <div class="input-group">
                    <label for="availability">Availability</label>
                    <select name="availability" id="availability" required>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" required>
                        <?php
                        $database = new connection();
                        $conn = $database->getConnection();
                        $query = "SELECT id, name FROM categories";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" required>
                </div>
                <button type="submit" class="btn-submit">Add Product</button>
            </form>
        </div>
    </main>
</section>

<script src="script.js"></script>
</body>
</html>
