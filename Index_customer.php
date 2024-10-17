<?php
session_start();
include "./admin_side.php";
require './Db/connection.php'; // Include your database connection file

// Check if the admin is logged in (you might want to implement this check)
if (!isset($_SESSION['username'])) {
    header('location: admin_login.php'); // Redirect to login if not logged in
    exit();
}


// Handle customer deletion
if (isset($_GET['delete'])) {
    $usernameToDelete = $_GET['delete'];

    // Delete query
    $database = new connection();
    try {
        $conn = $database->getConnection();
        $delete_sql = "DELETE FROM customers WHERE username = :username";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bindParam(':username', $usernameToDelete);
        $stmt->execute();

        $_SESSION['success'] = "Customer $usernameToDelete has been removed.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error deleting customer: " . $e->getMessage();
    }
}


// Fetch customers from the database
$database = new connection();
try {
    $conn = $database->getConnection();
    $query = "SELECT username, email FROM customers"; // Adjusted query to select only needed fields
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error'] = "Error fetching customers: " . $e->getMessage();
}
?>
<section id="content">
    <!-- NAVBAR -->
    <?php
    include "./admin_nav.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href=".//css/cus_style.Css"> <!-- Link to your CSS -->
</head>
<body>
    <div class="container">
        <h2>Registered Customers</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Customer Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers)) : ?>
                    <?php foreach ($customers as $customer) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($customer['username']); ?></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td>
                                <a href="?delete=<?php echo urlencode($customer['username']); ?>" onclick="return confirm('Are you sure you want to delete this customer?');">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No customers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <script src="script.js"></script>
</body>
</html>
