<?php
include '../includes/db_connect.php';
include '../includes/functions.php';
$title = "My Profile";

session_start();
$user_id = $_SESSION['user_id'];

// Fetch user's profile information using the getUserProfileInfo function
$user_info = getUserProfileInfo($user_id);

// Assign user's information to variables
$profile_image = $user_info['profile_image'];
$username = $user_info['username'];
$fullName = $user_info['fullName'];
$jobTitle = $user_info['jobTitle'];
$about = $user_info['about'];
$company = $user_info['company'];
$country = $user_info['country'];
$address = $user_info['address'];
$phone = $user_info['phone'];
$email = $user_info['email'];
$twitterURL = $user_info['twitterURL'];
$facebookURL = $user_info['facebookURL'];
$instagramURL = $user_info['instagramURL'];
$linkedinURL = $user_info['linkedinURL'];

// Check if the change password form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['passwordSubmit'])) {
    // Retrieve form data
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $renewPassword = $_POST['renewpassword'];

    // Check if new password and re-entered password match
    if ($newPassword !== $renewPassword) {
        echo "New password and re-entered password do not match.";
    } else {
        // Verify the current password
        // (You need to implement your own logic for password verification)
        $verified = password_verify($currentPassword, $user_info['password']); // Assuming you have a function for password verification

        if ($verified) {
            // Hash the new password before updating
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            // Update user's password in the database
            $sql = "UPDATE users SET password = :password WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();
            
            echo "Password changed successfully.";
        } else {
            echo "Incorrect current password.";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['profileImage']['name'];
    $file_tmp = $_FILES['profileImage']['tmp_name'];
    
    // Move the uploaded file to the desired directory
    $upload_dir = "../assets/img/profile/"; // Change this to your desired directory
    $destination = $upload_dir . $file_name;
    
    if (move_uploaded_file($file_tmp, $destination)) {
        // File uploaded successfully, update the database with the new image path
        $sql = "UPDATE users SET profile_image = :profile_image WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':profile_image', $destination);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        
        $_SESSION['success_message'] = "Profile image updated successfully.";
        // Redirect back to the profile page after updating
        header("Location: users-profile.php");
        exit();
    } else {
        echo "Failed to upload file.";
    }
}
// Check if the profile update form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user information
    $fullName = $_POST['fullName'];
    $jobTitle = $_POST['job'];
    $about = $_POST['about'];
    $company = $_POST['company'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $twitterURL = $_POST['twitter'];
    $facebookURL = $_POST['facebook'];
    $instagramURL = $_POST['instagram'];
    $linkedinURL = $_POST['linkedin'];

    // Update user information in the database
    $sql = "UPDATE users SET fullName = :fullName, jobTitle = :jobTitle, about = :about, company = :company, country = :country, address = :address, phone = :phone, email = :email, twitterURL = :twitterURL, facebookURL = :facebookURL, instagramURL = :instagramURL, linkedinURL = :linkedinURL WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':fullName', $fullName);
    $stmt->bindValue(':jobTitle', $jobTitle);
    $stmt->bindValue(':about', $about);
    $stmt->bindValue(':company', $company);
    $stmt->bindValue(':country', $country);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':twitterURL', $twitterURL);
    $stmt->bindValue(':facebookURL', $facebookURL);
    $stmt->bindValue(':instagramURL', $instagramURL);
    $stmt->bindValue(':linkedinURL', $linkedinURL);
    $stmt->bindValue(':user_id', $user_id);

    $stmt->execute();

    // Set success message
    $_SESSION['success_message'] = "Profile updated successfully.";
    // Redirect back to the profile page after updating
    header("Location: users-profile.php");
    exit();
}

// Check if the profile image upload form is submitted


ob_start();
include '../templates/users-profile.html.php';
$output = ob_get_clean();
include '../index.html.php';
?>







