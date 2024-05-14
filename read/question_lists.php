<?php
include '../includes/db_connect.php'; // Use '/' for directory separator
include '../includes/functions.php';

$title = 'Question List';
session_start();

try {
    // Define the default sorting column and order
    $sort_column = 'created_at'; // Default sorting column
    $sort_order = 'DESC'; // Default sorting order

    // Check if sorting criteria are provided
    if (isset($_POST['sort_column'])) {
        // Sanitize and validate sorting criteria
        $valid_columns = ['created_at', 'views']; // Define valid sorting columns
        $valid_orders = ['ASC', 'DESC']; // Define valid sorting orders

        list($sort_column, $sort_order) = explode('|', $_POST['sort_column']);

        // Validate the sorting column and order
        if (!in_array($sort_column, $valid_columns) || !in_array($sort_order, $valid_orders)) {
            throw new Exception('Invalid sorting criteria');
        }
    }

    

    // Output
    ob_start();
    include '../templates/question_lists.html.php'; // Use '/' for directory separator
    $output = ob_get_clean();
} catch (PDOException $e) {
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $output = 'Error: ' . $e->getMessage();
}

include '../index.html.php';
?>
