<?php
require './Db/connection.php';

session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        // Check if the user exists
        $login_sql = "SELECT * FROM customers WHERE username = :username LIMIT 1";
        $stmt = $conn->prepare($login_sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header('location:index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            header('location: customer_login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Internal server error.';
        header('location: customer_login.php');
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Login</title>
  <link rel="stylesheet" href="./Css/login.Css">
</head>
<body>
  <div class="container">
    <div class="myform">
      <h2>Customer Login</h2>
      <div class="aleart">
        <?php
       
        if (isset($_SESSION['error']))
          echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
        ?>
      </div>
      
      <form method="post" action="./customer_login_process.php">
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="submit">Login</button>
      </form>
      <div class="register-link">
        <p>Don't have an account? <a href="customer_register.php">Create an account</a></p>
      </div>
    </div>
  </div>
</body>
</html>
<style>
    body{
   
    background-size: cover;
    background-position: center;
    opacity: 0.6; /* Adjust for visibility */
    z-index: 1;
        background-image: url("./images/stuff/logcs.jpg");
    }
 </style>
