<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Admin Login Panel</title>
  <link rel="stylesheet" href="./css/adminlogin.css">
  <link rel="icon" href="../Images/Outer clove.png" type="image/x-icon">
</head>

<body>
<img src="./images/stuff/adminbg.jpeg" height="1000px" width="1550px" >
  <div class="container">
    <div class="myform">
      <div class="aleart">
        <?php

        session_start();

        if (isset($_SESSION['error']))
          echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
        ?>

      </div>
      
      <form method="post" action="./admin_login_process.php">
        <h2>HS Lanka ADMIN LOGIN</h2>
        <input type="text" placeholder="Admin Name" name="username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" name="submit">LOGIN</button>
      </form>
    </div>
    <div class="image">
      <img src="./images/stuff/adminbg1.jpg">
    </div>
  </div>

</body>

</html>