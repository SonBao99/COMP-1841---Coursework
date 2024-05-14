

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sonnbgch221038@fpt.edu.vn';
    $mail->Password = 'tsre mfnr ojbs yoxu';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress('sonnbgch221038@fpt.edu.vn');

    // Set email subject and body
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    if ($mail->send()) {
        echo '<p>Email sent successfully!</p>';
    } else {
        echo '<p>Error: ' . $mail->ErrorInfo . '</p>';
    }
}
?>
