<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation here
    include '../includes/db_connect.php';

    // Check if the username already exists
    $sql_check_username = "SELECT COUNT(*) AS count FROM users WHERE username = :username";
    $stmt_check_username = $pdo->prepare($sql_check_username);
    $stmt_check_username->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt_check_username->execute();
    $result = $stmt_check_username->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // Username already exists, handle the error (e.g., display an error message)
        $_SESSION['error_message'] = "Username already exists. Please choose a different username.";
        include '../templates/pages-register.html.php'; // Display the registration form with the error message
        exit(); // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 2;
    
    // Insert user data into the database
    $sql_insert_user = "INSERT INTO users (username, password, fullName, email, role_id) VALUES (:username, :password, :fullName, :email, :role_id)";
    $stmt_insert_user = $pdo->prepare($sql_insert_user);
    $stmt_insert_user->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt_insert_user->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt_insert_user->bindParam(':fullName', $_POST['fullName'], PDO::PARAM_STR);
    $stmt_insert_user->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt_insert_user->bindParam(':role_id', $role_id, PDO::PARAM_INT);
    $stmt_insert_user->execute();

    header('Location: user_login.php');
    exit(); // Stop further execution after redirection
}

include '../templates/pages-register.html.php';
?>
