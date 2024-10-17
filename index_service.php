<?php
include "./admin_side.php";
require './Db/connection.php'; // Include the database connection file
session_start();
$database = new connection();

try {
    // Get the database connection
    $conn = $database->getConnection();

    // Query to fetch services from the 'services' table
    $select_sql = "SELECT * FROM services";
    $stmt = $conn->query($select_sql);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all services
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php
    include "./admin_nav.php";
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
                        <a class="active" href="#">Service</a>
                    </li>
                </ul>
            </div>
            <a href="./add_service.php" class="btn-download">
                <li><i class='bx bx-plus'></i></li>
                <span class="text">Add Service</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Service Management</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <!-- Service table -->
                <table>
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($services)) : ?>
                            <?php foreach ($services as $service) : ?>
                                <tr>
                                    <td><?php echo $service['service_id']; ?></td>
                                    <td><?php echo $service['service_name']; ?></td>
                                    <td><?php echo $service['description']; ?></td>
                                    <td>
                                        <!-- Edit and Delete buttons with icons -->
                                        <form method="POST" action="./delete_service_process.php" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display:inline-block;">
                                            <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
                                            <button type="submit" name="delete_service" style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-trash" style="color:red; font-size:16px;"></i> <!-- Delete Icon -->
                                            </button>
                                        </form>

                                        <a href="edit_service.php?id=<?php echo $service['service_id']; ?>" style="text-decoration:none; margin-left:10px;">
                                            <button style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-edit" style="color:green; font-size:16px;"></i> <!-- Edit Icon -->
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">No services found.</td>
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
