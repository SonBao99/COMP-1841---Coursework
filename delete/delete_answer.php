<?php
include '../includes/db_connect.php'; // Include your database connection file
include '../includes/functions.php'; // Include your functions file if needed

session_start();

if (isset($_GET['answer_id'])) {
    $answer_id = $_GET['answer_id'];
    $question_id = $_GET['question_id'];

    // Check if the answer exists before attempting to delete it
    $sql_check = "SELECT COUNT(*) AS count FROM answers WHERE answer_id = :answer_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] > 0) {
        // answer exists, proceed with deletion
        $sql_delete = "DELETE FROM answers WHERE answer_id = :answer_id";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':answer_id', $answer_id, PDO::PARAM_INT);
        $stmt_delete->execute();

        $_SESSION['success_message'] = "Answer deleted successfully.";
        // Redirect to the page where the answer was deleted from
        header("Location: ../users/user_questions.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Answer not found.";
    }
} else {
    $_SESSION['error_message'] = "Answer ID or question ID not provided.";
}

// Redirect to the previous page if there's an error or missing parameters
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
