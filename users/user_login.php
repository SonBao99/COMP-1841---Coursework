<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input and sanitize data
    include '../includes/db_connect.php';
    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($user && password_verify($_POST['password'], $user['password'])) {
        
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        
        header("Location: ../index.php");
        exit();
    } else {
        // Password is incorrect, display error message
        $_SESSION['error_message'] = "Invalid username or password.";
    }
}
include '../templates/pages-login.html.php';
?>
