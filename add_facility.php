<?php
include "./admin_side.php";
include './Db/connection.php';
session_start();
?>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <?php include "./admin_nav.php"; ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Add Facility</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Add Facility</a></li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form action="add_facility_process.php" method="POST">
                <div class="input-group">
                    <label for="facility_name">Facility Name</label>
                    <input type="text" name="facility_name" id="facility_name" required>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Add Facility</button>
            </form>
        </div>
    </main>
</section>
<script src="script.js"></script>
</body>
</html>
