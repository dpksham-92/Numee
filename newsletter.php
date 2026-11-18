<?php
date_default_timezone_set('Asia/Kolkata'); // Set IST timezone

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "Invalid email address.";
        exit;
    }

    // Sender and recipient
    $fromEmail = "no-reply@callnumee.com";
    $to        = "anuj@syncrasytech.com";
    $subject   = "New Newsletter Subscription";

    // Detailed message content
    $message = "Hello,\n\n";
    $message .= "A new user has subscribed to your newsletter.\n\n";
    $message .= "Subscriber Details:\n";
    $message .= "📧 Email: $email\n";
    $message .= "🕒 Subscribed On: " . date("d M Y, h:i A") . "\n\n";
    $message .= "Please add this email to your mailing list.\n\n";
    $message .= "Regards,\n";
    $message .= "CallNumee Team\n";
    $message .= "https://callnumee.com";

    // Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
    $headers .= "From: $fromEmail\r\n";
    $headers .= "Reply-To: $fromEmail\r\n";

    if (mail($to, $subject, $message, $headers)) {
        header("Location: thank-you.php");
        exit;
    } else {
        echo "Sorry, message could not be sent.";
    }
} else {
    echo "Invalid Request.";
}
?>
