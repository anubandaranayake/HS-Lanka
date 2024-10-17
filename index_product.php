<?php
include "./admin_side.php";
require './Db/connection.php'; 
session_start();
$database = new connection();

try {
    $conn = $database->getConnection();

    // Updated SQL to match the new table structure, using 'image' column for product images
    $select_sql = "
        SELECT p.id AS product_id, p.code, p.name, p.description, p.quantity, p.Price, p.availability, 
               c.name AS category_name, p.image AS product_image
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
    ";
    $stmt = $conn->query($select_sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <?php include "./admin_nav.php"; ?>
    <main>
        <div class="alert">
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>
        </div>
        <div class="head-title">
            <div class="left">
                <h1>Product Management</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Products</a></li>
                </ul>
            </div>
            <a href="./add_product.php" class="btn-download">
                <li><i class='bx bx-plus'></i></li>
                <span class="text">Add Product</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Product List</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Category</th>              
                            <th>Product Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?php echo $product['product_id']; ?></td>
                                    <td><?php echo $product['code']; ?></td>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['description']; ?></td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td><?php echo number_format($product['Price'], 2); ?></td>
                                    <td><?php echo $product['availability'] ? 'Available' : 'Not Available'; ?></td>
                                    <td><?php echo $product['category_name']; ?></td>
                                    <td><img src="<?php echo $product['product_image']; ?>" alt="Product Image" style="width: 100px; height: 75px;"></td>
                                    <td>
                                        <form method="POST" action="./delete_product_process.php" onsubmit="return confirm('Are you sure you want to delete this product?');" style="display:inline-block;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                            <button type="submit" name="delete_product" style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-trash" style="color:red; font-size:16px;"></i>
                                            </button>
                                        </form>
                                        <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" style="text-decoration:none; margin-left:10px;">
                                            <button style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-edit" style="color:green; font-size:16px;"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>

<script src="script.js"></script>
</body>
</html>
