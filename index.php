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
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>
            <a href="#" class="btn-download">
                <i class='bx bxs-dashboard'></i>
                <span class="text">welcome admin</span>
            </a>
        </div>
      
      
        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>10</h3>
                    <p>New Order</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>12</h3>
                    <p>Visitors</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>RS 6000</h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>
        <br>
        
       


        <div class="table-data">
        <img src="./images/logo/logo2.png">
            <h3>Welcome to the page<br> of HS LANKA</h3>
              
        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->


<script src="script.js"></script>
</body>

</html>
<style>
    body{
        background-image: url("./images/stuff/bg2.jpg");
    }
   .table-data{
    font: 4em sans-serif;
    color: 69052B;
   }
</style>