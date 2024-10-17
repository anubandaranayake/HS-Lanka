<?php
require './Db/connection.php'; // Include your database connection
session_start();

// Get the offer ID from the URL
$offer_id = $_GET['id'];

// Create an instance of the connection class
$database = new connection();

try {
    // Establish database connection
    $conn = $database->getConnection();

    // Fetch offer details from the database
    $select_sql = "SELECT * FROM offers WHERE offer_id = :id";
    $stmt = $conn->prepare($select_sql);
    $stmt->bindParam(':id', $offer_id, PDO::PARAM_INT);
    $stmt->execute();
    $offer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$offer) {
        $_SESSION['error'] = "Offer not found!";
        header('location:index_offer.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<?php include "./admin_side.php"; ?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include "./admin_nav.php"; ?>
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Offer Management</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Offer</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form method="POST" action="./update_offer_process.php">
                <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                
                <div class="input-group">
                    <label for="offer_name">Offer Name:</label>
                    <input type="text" name="offer_name" id="offer_name" value="<?php echo $offer['offer_name']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required><?php echo $offer['description']; ?></textarea>
                </div>

                <button type="submit" name="update_offer" class="btn-submit">Update Offer</button>
            </form>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>
</html>
