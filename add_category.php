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
                <h1>Category Management</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-right-arrow-alt'></i></li>

                    <li>
                        <a class="active" href="#">Category</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-container">
            <form action="add_category_process.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" required>
                </div>
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" required>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Add Category</button>
            </form>
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->


<script src="script.js"></script>
</body>
</html>
