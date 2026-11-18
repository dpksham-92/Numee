<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    // Replace this with your actual email address
    $fromEmail = "no-reply@callnumee.com";
    $to      = "kerstin.spurk@we-empower-you.de, anuj@syncrasytech.com";
    $subject = "Join Waitlist";
    $message = "Name: $name\nEmail: $email";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();


    if (mail($to, $subject, $message, $headers)) {
        // echo "Thanks, your message has been sent.";
        header("Location: thank-you.php");
    } else {
        echo "Sorry, message could not be sent.";
    }
} else {
    echo "Invalid Request.";
}
?>