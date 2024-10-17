<?php
include_once "./index_Cus.php"; // Adjust the path if necessary
require './Db/connection.php'; 

$database = new connection();
$conn = $database->getConnection();

$searchResults = [];
$searchQuery = '';

// Handle search form submission
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search_query'];
    
    // Prepare and execute the search query
    $stmt = $conn->prepare("
        SELECT p.* 
        FROM products p 
        WHERE p.name LIKE :search_query AND p.availability = 1
    ");
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bindParam(':search_query', $searchTerm);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Search</title>
    <link rel="stylesheet" href="./css/search.css"> <!-- Include your styles -->
</head>
<body>
<section id="content">
    <main>
        <h1>Search Products</h1>
        
        <form method="POST" action="">
            <input type="text" name="search_query" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search for products..." required>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (!empty($searchResults)): ?>
            <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
            <div class="product-grid">
                <?php foreach ($searchResults as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 200px; height: 200px;">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p>Price: Rs <?php echo number_format($product['Price'], 2); ?></p>
                        <p>Quantity Available: <?php echo $product['quantity']; ?></p>
                        <form method="POST" action="Cart.php">
                            <input type="number" name="quantity" value="1" min="1" style="width: 50px;">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" name="add_to_cart" class="cart-button">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <?php if ($searchQuery): ?>
                <p>No results found for "<?php echo htmlspecialchars($searchQuery); ?>".</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</section>
<script src="scripts.js"></script>
</body>
</html>
