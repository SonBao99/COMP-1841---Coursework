<?php
include "../includes/db_connect.php";
include "../includes/functions.php";

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_info = getUserProfileInfo($user_id);
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: ../users/user_login.php");
    exit();
}

try {
    // Retrieve questions of the current user
    $sql = "SELECT * FROM questions WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$title = 'Your Questions';
ob_start();
include '../templates/user_questions.html.php';
$output = ob_get_clean();
include '../index.html.php';
?>
