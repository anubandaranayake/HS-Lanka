<?php
require './Db/connection.php'; // Include your database connection
session_start();

// Get the service ID from the URL
$service_id = $_GET['id'];

// Create an instance of the connection class
$database = new connection();

try {
    // Establish database connection
    $conn = $database->getConnection();

    // Fetch service details from the database
    $select_sql = "SELECT * FROM services WHERE service_id = :id";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':id', $service_id, PDO::PARAM_INT);
    $stmt->execute();
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        $_SESSION['error'] = "Service not found!";
        header('location:index_service.php');
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
                <h1>Service Management</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Service</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-container">

            <form method="POST" action="./update_service_process.php" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
                <div class="input-group">
                    <label for="service_name">Service Name:</label>
                    <input type="text" name="service_name" id="service_name" value="<?php echo $service['service_name']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required><?php echo $service['description']; ?></textarea>
                </div>

                <button type="submit" name="update_service" class="btn-submit">Update Service</button>
            </form>

        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>

</html>
