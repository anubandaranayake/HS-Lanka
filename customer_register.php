<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Registration</title>
  <link rel="stylesheet" href="./Css/reg.Css">
</head>
<body>
  <div class="container">
    <div class="myform">
      <h2>Customer Registration</h2>
      <div class="aleart">
        <?php
        session_start();
        if (isset($_SESSION['error']))
          echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
        ?>
      </div>
      
      <form method="post" action="./customer_register_process.php">
        <input type="text" placeholder="Username" name="username" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="submit">Register</button>
      </form>
      <div class="login-link">
        <p>Already have an account? <a href="customer_login.php">Login here</a></p>
      </div>
    </div>
  </div>
</body>
</html>
<style>
    body{
   
    background-size: cover;
    background-position: center;
    opacity: 0.9; /* Adjust for visibility */
    z-index: 1;
        background-image: url("./Images/stuff/order.webp");
    }
 </style>
