<?php
include "./admin_side.php";
require './Db/connection.php'; // Include the database connection file
session_start();
$database = new connection();

try {
    // Get the database connection
    $conn = $database->getConnection();

    // Query to fetch facilities from the 'facilities' table
    $select_sql = "SELECT * FROM facilities";
    $stmt = $conn->query($select_sql);
    $facilities = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all facilities
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include "./admin_nav.php" ?>

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
                <h1>Facility Management</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Facilities</a></li>
                </ul>
            </div>
            <a href="./add_facility.php" class="btn-download">
                <li><i class='bx bx-plus'></i></li>
                <span class="text">Add Facility</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Manage Facilities</h3>
                </div>

                <!-- Facility table -->
                <table>
                    <thead>
                        <tr>
                            <th>Facility ID</th>
                            <th>Facility Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($facilities)) : ?>
                            <?php foreach ($facilities as $facility) : ?>
                                <tr>
                                    <td><?php echo $facility['facility_id']; ?></td>
                                    <td><?php echo $facility['facility_name']; ?></td>
                                    <td><?php echo $facility['description']; ?></td>
                                    <td>
                                        <!-- Edit and Delete buttons with icons -->
                                        <form method="POST" action="./delete_facility_process.php" onsubmit="return confirm('Are you sure you want to delete this facility?');" style="display:inline-block;">
                                            <input type="hidden" name="facility_id" value="<?php echo $facility['facility_id']; ?>">
                                            <button type="submit" name="delete_facility" style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-trash" style="color:red; font-size:16px;"></i> <!-- Delete Icon -->
                                            </button>
                                        </form>

                                        <a href="edit_facility.php?id=<?php echo $facility['facility_id']; ?>" style="text-decoration:none; margin-left:10px;">
                                            <button style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-edit" style="color:green; font-size:16px;"></i> <!-- Edit Icon -->
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">No facilities found.</td>
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
