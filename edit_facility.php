<?php
require './Db/connection.php'; // Include your database connection
session_start();

// Get the facility ID from the URL
$facility_id = $_GET['id'];

// Create an instance of the connection class
$database = new connection();

try {
    // Establish database connection
    $conn = $database->getConnection();

    // Fetch facility details from the database
    $select_sql = "SELECT * FROM facilities WHERE facility_id = :id";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':id', $facility_id, PDO::PARAM_INT);
    $stmt->execute();
    $facility = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$facility) {
        $_SESSION['error'] = "Facility not found!";
        header('location:index_facility.php');
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
                <h1>Facility Management</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Facility</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form method="POST" action="./update_facility_process.php">
                <input type="hidden" name="facility_id" value="<?php echo $facility['facility_id']; ?>">
                
                <div class="input-group">
                    <label for="name">Facility Name:</label>
                    <input type="text" name="facility_name" id="name" value="<?php echo $facility['facility_name']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required><?php echo $facility['description']; ?></textarea>
                </div>

                <button type="submit" name="update_facility" class="btn-submit">Update Facility</button>
            </form>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>
</html>
