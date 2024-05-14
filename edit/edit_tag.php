<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

session_start();

if (isset($_POST['tag_id'], $_POST['name'])) {
    $tag_id = $_POST['tag_id'];
    $new_name = $_POST['name'];

    // Update the tag in the database
    $sql = "UPDATE tags SET name = :name WHERE tag_id = :tag_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
    $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['success_message'] = "Tag updated successfully.";
    // Redirect back to the page where the form was submitted from
    // or any other appropriate page
    header("Location: manage.php");
    exit();
} else {
    // Handle the case where required POST parameters are missing
    // Redirect to an error page or display an error message
}
?>
