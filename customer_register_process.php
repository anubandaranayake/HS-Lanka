<?php
require './Db/connection.php';


session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password hashing

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        // Check if username or email already exists
        $check_sql = "SELECT * FROM customers WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $conn->prepare($check_sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Username or Email already exists.';
            header('location: customer_register.php');
            exit();
        } else {
            // Insert customer into database
            $register_sql = "INSERT INTO customers (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($register_sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $_SESSION['username'] = $username;
            header('location: customer_login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Internal server error.';
        header('location: customer_register.php');
        exit();
    }
}
?>
