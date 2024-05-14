<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

if (isset($_POST['answer_id'])) {
    $answer_id = $_POST['answer_id'];
    $body = $_POST['body'];
    $question_id = $_POST['question_id'];
    // Update the answer in the database
    $sql = "UPDATE answers SET body = :body WHERE answer_id = :answer_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['success_message'] = "Answer updated successfully.";
    // Redirect back to the page where the form was submitted from
    header("Location: ../read/questions.php?question_id=$question_id");
    exit();
} else {
    $_SESSION['error_message'] = "Required parameters missing.";
    header("Location: ../read/question.php?question_id=" . $_POST['question_id'] . "&error=1");
    exit();
}
?>
