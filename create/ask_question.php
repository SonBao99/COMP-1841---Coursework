<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    
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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $title = $_POST['title'];
        $body = $_POST['body'];
        $tag_id = $_POST['tag_id']; // Modified to retrieve tag_id instead of tag

        // Retrieve user_id from session
        $user_id = $_SESSION['user_id'];

        // Initialize the question image variable
        $uploadFile = null;

        // Handle image upload if a file is uploaded
        if(isset($_FILES['question_image']) && $_FILES['question_image']['error'] === UPLOAD_ERR_OK) {
            // Define upload directory and filename
            $uploadDir = '../assets/img/question/';
            $uploadFile = $uploadDir . basename($_FILES['question_image']['name']);

            // Move the uploaded file to the upload directory
            if(move_uploaded_file($_FILES['question_image']['tmp_name'], $uploadFile)) {
                // Image upload successful
            } else {
                $_SESSION['error_message'] = "Error uploading image. Please try again.";
                header("Location: ask_question.php");
            }
        }

        // Insert the data into the database
        $stmt = $pdo->prepare("INSERT INTO questions (user_id, title, body, tag_id, question_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $title, $body, $tag_id, $uploadFile]);

        // Redirect user to a success page or wherever you want after submission
        $_SESSION['success_message'] = "Your question has been submitted successfully!";
        header("Location: ../users/user_questions.php");
        exit();
    }

    // If the form is not submitted or there's an error, include the form again
    $title = 'Ask a public Question';
    ob_start();
    include '../templates\ask_question.html.php';
    $output = ob_get_clean();
    include '../index.html.php';
} else {
    // If the user is not logged in, redirect to the login pagebhn
    header("Location: ../users/user_login.php");
    exit();
}
?>
