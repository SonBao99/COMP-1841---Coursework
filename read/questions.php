<?php
include '../includes\db_connect.php';
include '../includes\functions.php';
session_start();


$question_id = $_GET['question_id'];
// Update views count for the question
$sql = "UPDATE questions SET views = views + 1 WHERE question_id = :question_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
$stmt->execute();

try {
    // Prepare the SQL query to fetch all answers for a specific question
    $sql = "SELECT * FROM answers WHERE question_id = :question_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':question_id', $_GET['question_id'], PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all answers as an associative array
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if (isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];

    try {
        // Prepare the SQL query to fetch question details by ID
        $sql = "SELECT * FROM questions WHERE question_id = :question_id";
        $stmt = $pdo->prepare($sql);

        // Bind the question ID parameter
        $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the question details
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        $question_content = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = 'Question Details';
        ob_start();
        include '../templates\questions.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "question ID not provided.";
}

include '../index.html.php';
?>
