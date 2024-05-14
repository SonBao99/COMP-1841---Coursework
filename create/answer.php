<?php
include '../includes/db_connect.php';
include '../includes/functions.php';


session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if question_id and body are set in the POST data
    if (isset($_POST['question_id']) && isset($_POST['body'])) {
        $question_id = $_POST['question_id'];
        $body = $_POST['body'];
        // Insert the answer into the database
        try {
            $sql = "INSERT INTO answers (user_id, question_id, body, created_at) 
                    VALUES (:user_id, :question_id, :body, NOW())";
            $stmt = $pdo->prepare($sql);
            // For demonstration purposes, assuming user_id is hardcoded here, replace with actual user_id
            $user_id = $_SESSION['user_id']; // Replace with the actual user_id
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->execute();
            
            $_SESSION['success_message'] = "Answer added successfully.";
            // Redirect back to the question page after successful insertion
            header("Location: ../read/questions.php?question_id=$question_id");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid input data.";
    }
} else {
    // If request method is not POST, fetch all answers from the database
    
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

    // Include the HTML template to display the answers
    include '../read/questions.php';
}

?>
