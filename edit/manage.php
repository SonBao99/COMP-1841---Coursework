<?php

include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();


$sql = "SELECT * FROM users";
$result = $pdo->query($sql);
$users = $result->fetchAll(PDO::FETCH_ASSOC);

try{
    $sql = "SELECT * FROM roles";
    $stmt = $pdo->query($sql);
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

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

try {
    $sql = "SELECT * FROM questions";
    $stmt = $pdo->query($sql);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$title = "Manage";
ob_start();
include '../templates/manage.html.php';
$output = ob_get_clean();
include '../index.html.php';
