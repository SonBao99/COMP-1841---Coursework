<?php

include 'includes\db_connect.php';
include 'includes\functions.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_info = getUserProfileInfo($_SESSION['user_id']);
}
else {
    $user_info = array(
        'fullName' => 'Guest'
    );}


$title = 'Home';
$output = '<h3>Welcome to StackOverFlew, ' . $user_info['fullName'] . '<span class="wave">👋</span>.</h3>';

include 'index.html.php';
