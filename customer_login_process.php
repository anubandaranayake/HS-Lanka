<?php
require_once './Db/connection.php';

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
            header('location:index_Cus.php');
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
