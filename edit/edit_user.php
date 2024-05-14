<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();


// Check if user_id is provided in the URL
if (!isset($_POST['user_id'])) {
    // Redirect to index page if user_id is not provided
    $_SESSION['error_message'] = "user ID not provided.";
    header("Location: ../index.php");
    exit();
}

// Get user_id from URL
$user_id = $_POST['user_id'];


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $role = $_POST['role_id'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username = :username, role_id = :role_id, email = :email WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':role_id', $role, PDO::PARAM_INT);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Set success message
    $_SESSION['success_message'] = "User updated successfully.";

    // Redirect to user details page after editing
    header("Location: manage.php");
    exit();
}

// If the code reaches here, it means it's a GET request and we need to display the form for editing the user

include '../templates/manage.html.php';
