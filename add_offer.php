<?php
include "./admin_side.php";
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include "./admin_nav.php"; ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Add Offer</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-right-arrow-alt'></i></li>
                    <li><a class="active" href="#">Add Offer</a></li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form action="add_offer_process.php" method="POST">
                <div class="input-group">
                    <label for="offer_name">Offer Name</label>
                    <input type="text" name="offer_name" id="offer_name" required>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Add Offer</button>
            </form>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="script.js"></script>
</body>
</html>
