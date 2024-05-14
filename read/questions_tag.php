<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();


try {
    // Retrieve the tag information
    $tag_id = $_GET['tag_id'];
    $tag_query = "SELECT * FROM tags WHERE tag_id = :tag_id";
    $tag_stmt = $pdo->prepare($tag_query);
    $tag_stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $tag_stmt->execute();
    $tag = $tag_stmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve questions with the specified tag
    $sql = "SELECT * FROM questions WHERE tag_id = :tag_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$title = 'Questions with Tag ';
ob_start();
include '../templates/questions_tag.html.php';
$output = ob_get_clean();
include '../index.html.php';
?>
