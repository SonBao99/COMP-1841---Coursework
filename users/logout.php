<?php
// Start the session
session_start();

// If the session exists, destroy it
if (isset($_SESSION)) {
    session_destroy();
}

// Redirect the user to the login page
header("Location: ../index.php");
exit(); // Stop further execution
?>
