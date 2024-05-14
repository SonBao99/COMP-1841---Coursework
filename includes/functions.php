<?php


function get_rolename_by_id($role_id)
{
    global $pdo; // Assuming $pdo is a global variable for your PDO connection

    try {
        $sql = "SELECT role_name FROM roles WHERE role_id = :role_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->execute();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($role) {
            return $role['role_name'];
        } else {
            return "Role not found"; // Handle case where role ID doesn't exist
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; // Or handle error differently
    }
}

function get_username_by_id($user_id)
{
    global $pdo; // Assuming $pdo is a global variable for your PDO connection

    try {
        $sql = "SELECT username FROM users WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user['username'];
        } else {
            return "User not found"; // Handle case where user ID doesn't exist
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; // Or handle error differently
    }
}



// Check if a search term is provided
if (isset($_GET['search_term']) && !empty($_GET['search_term'])) {
    // Retrieve the search term from user input
    $search_term = '%' . $_GET['search_term'] . '%';

    try {
        // Prepare the SQL query to search for questions
        $sql = "SELECT *
                FROM questions
                WHERE title LIKE :search_term OR body LIKE :search_term LIKE :search_term";
        $stmt = $pdo->prepare($sql);

        // Bind the search term parameter
        $stmt->bindParam(':search_term', $search_term, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the search results
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        // Execute a query to retrieve all questions
        $sql = "SELECT * FROM questions";
        $stmt = $pdo->query($sql);

        // Fetch all questions
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}




function getUserProfileInfo($user_id)
{
    global $pdo; // Assuming $pdo is available in this scope

    // Fetch user's information including role from the database
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);

    // Check if user exists
    if ($stmt->rowCount() > 0) {
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user_info;
    } else {
        return false; // Return false if user not found
    }
}


date_default_timezone_set('Asia/Ho_Chi_Minh');


function calculateTimeLabel($created_at)
{
    // Convert the provided date string to a Unix timestamp
    $timestamp = strtotime($created_at);

    // Get the current timestamp
    $now = time();

    // Calculate the absolute difference between the current time and the provided timestamp
    $delta = abs($now - $timestamp);

    // Determine the time label based on the absolute difference
    if ($delta < 60) {
        return "$delta sec";
    } else if ($delta < 3600) {
        $minutes = round($delta / 60);
        return "$minutes min";
    } else if ($delta < 86400) {
        $hours = round($delta / 3600);
        return "$hours hrs";
    } else if ($delta < 604800) {
        $days = round($delta / 86400);
        return "$days day";
    } else if ($delta < 2592000) {
        $weeks = round($delta / 604800);
        return "$weeks weeks";
    } else {
        $years = round($delta / 31536000);
        return "$years years";
    }
}


function sortQuestions($questions)
{
    // Sort the questions array using a custom comparison function
    usort($questions, function ($q1, $q2) {
        // Convert the timestamps to UNIX timestamps for comparison
        $timestamp1 = strtotime($q1['created_at']);
        $timestamp2 = strtotime($q2['created_at']);

        // Compare the timestamps and return the result
        if ($timestamp1 === false || $timestamp2 === false) {
            // Handle cases where timestamp conversion fails
            return 0; // No change in order
        } else {
            // Sort in descending order (latest first)
            return $timestamp2 - $timestamp1;
        }
    });


    
    // Return the sorted array
    return $questions;
}



function truncateDescription($description, $length)
{
    if (strlen($description) > $length) {
        // Truncate the description and add ellipsis
        $truncated_description = substr($description, 0, $length) . '...';
        return $truncated_description;
    } else {
        return $description;
    }
}


function getTagNameById($pdo, $tag_id) {
    $tag_sql = "SELECT name FROM tags WHERE tag_id = :tag_id";
    $tag_stmt = $pdo->prepare($tag_sql);
    $tag_stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
    $tag_stmt->execute();
    $tag_name = $tag_stmt->fetch(PDO::FETCH_ASSOC)['name'];
    return $tag_name;
}

function getNumberReplies($pdo, $question_id) {
    $sql = "SELECT COUNT(*) AS num_replies FROM answers WHERE question_id = :question_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
    $num_replies = $stmt->fetch(PDO::FETCH_ASSOC)['num_replies'];
    return $num_replies;
}



?>


