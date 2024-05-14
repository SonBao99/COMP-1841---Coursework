<?php 

include '../includes/db_connect.php';
include '../includes/functions.php';

if (isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];
    $sql = "DELETE FROM questions WHERE question_id = :question_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $_SESSION['success_message'] = "Question deleted successfully.";
    header("Location: ../users/user_questions.php");
    exit();
}
else {
    $_SESSION['error_message'] = "Question ID not provided.";
    header("Location: ../users/user_questions.php");
    exit();
}