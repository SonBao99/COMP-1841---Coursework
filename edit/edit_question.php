<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();


// Check if question_id is provided in the URL
if (!isset($_GET['question_id'])) {
    // Redirect to index page if question_id is not provided
    $_SESSION['error_message'] = "Question ID not provided.";
    header("Location: ../index.php");
    exit();
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
// Get question_id from URL
$question_id = $_GET['question_id'];

// Retrieve question details from the database
$sql = "SELECT * FROM questions WHERE question_id = :question_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
$stmt->execute();
$question = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $body = $_POST['body'];
    $tag_id = $_POST['tag_id'];

    $question_image = $question['question_image'];
    // Validate uploaded image
    if ($_FILES['question_image']['error'] === UPLOAD_ERR_OK) {
        $uploadFile = $_FILES['question_image']['tmp_name'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if ($_FILES['question_image']['size'] > $maxFileSize) {
            $_SESSION['error_message'] = "File size exceeds the limit of 2MB.";
            header("Location: edit_question.php?question_id=$question_id");
            exit();
        }

        if (!in_array($_FILES['question_image']['type'], $allowedTypes)) {
            $_SESSION['error_message'] = "Only JPG, PNG, and GIF file types are allowed.";
            header("Location: edit_question.php?question_id=$question_id");
            exit();
        }
    }
    // Retrieve existing image path
    

    // Handle image upload if a new file is uploaded
    if (isset($_FILES['question_image']) && $_FILES['question_image']['error'] === UPLOAD_ERR_OK) {
        // Define upload directory and filename
        $uploadDir = '../assets/img/question/';
        $uploadFile = $uploadDir . basename($_FILES['question_image']['name']);

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['question_image']['tmp_name'], $uploadFile)) {
            // Update question_image variable with new image path
            $question_image = $uploadFile;
        } else {
            $_SESSION['error_message'] = "Error uploading file.";
            header("Location: edit_question.php?question_id=$question_id");
            exit();
        }
    }

    // Update the question details and image path in the database
    $sql = "UPDATE questions SET title = :title, body = :body, tag_id = :tag_id, question_image = :question_image WHERE question_id = :question_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $stmt->bindParam(':question_image', $question_image, PDO::PARAM_STR);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();

    // Set success message
    $_SESSION['success_message'] = "Question updated successfully.";

    // Redirect to question details page after editing
    header("Location: ../read/questions.php?question_id=$question_id");
    exit();
}

// If the code reaches here, it means it's a GET request and we need to display the form for editing the question
$title = 'Edit Question';
ob_start();
include '../templates/edit_question.html.php';
$output = ob_get_clean();
include '../index.html.php';
