<?php
include_once "./admin_side.php"; // Sidebar inclusion
require './Db/connection.php'; // Database connection
session_start();

// Create database connection
$database = new connection();

try {
    // Get the database connection
    $conn = $database->getConnection();

    // Fetch reviews from the 'reviews' table (assuming you have a reviews table)
    $select_sql = "SELECT name, email, customer_username, message FROM reviews";
    $stmt = $conn->query($select_sql);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all reviews
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <?php
    include_once "./admin_nav.php"; // Navigation inclusion
    ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Review</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-data">
            <div class="reviews">
                <div class="head">
                    <h3>Customer Reviews</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reviews)) : ?>
                            <?php foreach ($reviews as $review) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($review['name']); ?></td>
                                    <td><?php echo htmlspecialchars($review['email']); ?></td>
                                    <td><?php echo htmlspecialchars($review['customer_username']); ?></td>
                                    <td><?php echo htmlspecialchars($review['message']); ?></td>
                                    <td>
                                        <a href="#" class="btn-delete" onclick="deleteReview(this)">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No reviews found.</td>
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

<script>
function deleteReview(element) {
    if (confirm("Are you sure you want to delete this review?")) {
        // Implement deletion logic here (e.g., send request to server)
        // For now, simply remove the row from the table
        var row = element.closest('tr');
        row.parentNode.removeChild(row);
    }
}
</script>
<style>
/* General table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

thead th {
    background-color: #f2f2f2;
    padding: 12px;
    text-align: left;
    font-weight: bold;
}

tbody td {
    padding: 12px;
    text-align: left;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

.btn-delete {
    color: red;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-delete:hover {
    color: darkred;
}
</style>
