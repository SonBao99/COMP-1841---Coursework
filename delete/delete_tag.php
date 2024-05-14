<?php
include '../includes/db_connect.php'; // Include your database connection file
include '../includes/functions.php'; // Include your functions file if needed

session_start();

if (isset($_GET['tag_id'])) {
    $tag_id = $_GET['tag_id'];

    // Check if the tag exists before attempting to delete it
    $sql_check = "SELECT COUNT(*) AS count FROM tags WHERE tag_id = :tag_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] > 0) {
        // Tag exists, proceed with deletion
        $sql_delete = "DELETE FROM tags WHERE tag_id = :tag_id";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
        $stmt_delete->execute();

        $_SESSION['success_message'] = "Tag deleted successfully.";
        // Redirect to the page where the tag was deleted from
        // or any other appropriate page
        header("Location: ../edit/manage.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Tag not found.";
    }
} else {
    $_SESSION['error_message'] = "Tag ID not provided.";
}
?>
