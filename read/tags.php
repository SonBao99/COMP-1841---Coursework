<?php
include "../includes/db_connect.php";
include "../includes/functions.php";

session_start();

try {
    $sql = "SELECT tags.*, COUNT(questions.tag_id) AS num_questions 
            FROM tags 
            LEFT JOIN questions ON tags.tag_id = questions.tag_id 
            GROUP BY tags.tag_id";
    $stmt = $pdo->query($sql);
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$title = 'Tags';
ob_start();
include '../templates/tags.html.php';
$output = ob_get_clean();
include '../index.html.php';
?>
