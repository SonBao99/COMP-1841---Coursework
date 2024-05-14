<?php
// Include your database connection file
include '../includes/db_connect.php';
// Include your functions file if needed
include '../includes/functions.php';

session_start();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Check if the user exists before attempting to delete it
    $sql_check = "SELECT COUNT(*) AS count FROM users WHERE user_id = :user_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] > 0) {
        // User exists, proceed with deletion
        $sql_delete = "DELETE FROM users WHERE user_id = :user_id";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_delete->execute();

        $_SESSION['success_message'] = "User deleted successfully.";
        // Redirect to an appropriate page after deletion
        header("Location: ../edit/manage.php");
        exit();
    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: ../edit/manage.php");

}

}

?>
