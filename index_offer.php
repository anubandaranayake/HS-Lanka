<?php
include "./admin_side.php";
require './Db/connection.php'; // Include the database connection file
session_start();
$database = new connection();

try {
    // Get the database connection
    $conn = $database->getConnection();

    // Query to fetch offers from the 'offers' table
    $select_sql = "SELECT * FROM offers";
    $stmt = $conn->query($select_sql);
    $offers = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all offers
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include "./admin_nav.php"; ?>

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
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Offers</a></li>
                </ul>
            </div>
            <a href="./add_offer.php" class="btn-download">
                <li><i class='bx bx-plus'></i></li>
                <span class="text">Add Offer</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Offer Management</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <!-- Offer table -->
                <table>
                    <thead>
                        <tr>
                            <th>Offer Id</th>
                            <th>Offer Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($offers)) : ?>
                            <?php foreach ($offers as $offer) : ?>
                                <tr>
                                    <td><?php echo $offer['offer_id']; ?></td>
                                    <td><?php echo $offer['offer_name']; ?></td>
                                    <td><?php echo $offer['description']; ?></td>
                                    <td>
                                        <!-- Edit and Delete buttons with icons -->
                                        <form method="POST" action="./delete_offer_process.php" onsubmit="return confirm('Are you sure you want to delete this offer?');" style="display:inline-block;">
                                            <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                                            <button type="submit" name="delete_offer" style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-trash" style="color:red; font-size:16px;"></i> <!-- Delete Icon -->
                                            </button>
                                        </form>

                                        <a href="edit_offer.php?id=<?php echo $offer['offer_id']; ?>" style="text-decoration:none; margin-left:10px;">
                                            <button style="border:none; background:none; cursor:pointer;">
                                                <i class="fas fa-edit" style="color:green; font-size:16px;"></i> <!-- Edit Icon -->
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">No offers found.</td>
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
