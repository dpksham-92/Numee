<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get & sanitize
    $name  = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Sender (IMPORTANT: use real domain email)
    $fromEmail = "no-reply@callnumee.com";

    // =========================
    // 1. EMAIL TO USER
    // =========================
    $toUser = $email;
    $subjectUser = "You’re In! Welcome to the NuMee Waitlist";

    $messageUser = "
    <html>
    <body style='font-family: Arial;'>
        <div style='max-width:600px;margin:auto;padding:20px;'>
            <h2>Hi $name,</h2>
            <p>Thank you for joining the NuMee waitlist!</p>
            <p>You’ve taken the first step toward discovering your AI-powered personal mentor.</p>

            <p><a href='https://forms.office.com/Pages/ResponsePage.aspx?id=BZHu2AqWVE2tRLJb87b-COreJ2KFeKVEjHmeEfR0obBUQzM4TDFYUlY3UzRYQTNFSUFIMkdYUlRGQyQlQCN0PWcu'
            style='display:inline-block;padding:10px 15px;background:#5C67F2;color:#fff;text-decoration:none;border-radius:5px;'>
            Take the Survey</a></p>

            <p>Warm regards,<br><strong>Team NuMee</strong></p>
        </div>
    </body>
    </html>
    ";

    $headersUser  = "MIME-Version: 1.0\r\n";
    $headersUser .= "Content-type:text/html;charset=UTF-8\r\n";
    $headersUser .= "From: NuMee <$fromEmail>\r\n";

    // =========================
    // 2. EMAIL TO ADMIN
    // =========================
    $toAdmin = "anuj@syncrasytech.com, dpksham92@gmail.com";
    $subjectAdmin = "New Waitlist Signup";

    $messageAdmin = "
    <html>
    <body style='font-family: Arial;'>
        <div style='max-width:600px;margin:auto;padding:20px;'>
            <h2>Hi,</h2>
            <p>Thank you for joining the NuMee waitlist!</p>
            <p>You’ve taken the first step toward discovering your AI-powered personal mentor (YPM), a trusted, private, and personalized guide for your career.</p>
            <p>We’ll keep you posted as we prepare for launch. As an early joiner, you’ll get:</p>
            <ul>
                <li>Priority access to NuMee before the public</li>
                <li>Discounted subscription fees for 1st Year</li>
                <li>A chance to co-shape features via early feedback</li>
            </ul>
            <p><strong>Want to increase your impact?</strong></p>
            <p>Take our short survey and help NuMee learn how to support people just like you.</p>
            <p><a target=\"_blank\" href=\"https://forms.office.com/Pages/ResponsePage.aspx?id=BZHu2AqWVE2tRLJb87b-COreJ2KFeKVEjHmeEfR0obBUQzM4TDFYUlY3UzRYQTNFSUFIMkdYUlRGQyQlQCN0PWcu\" class=\"button\">Take the 3-Min Survey Now</a></p>
            <p>Thanks again for believing in a better way to shape your future.</p>
            <p>Warm regards,<br><strong>Team NuMee</strong><br>Your Career. Your Mentor. Your Future.</p>
        </div>
    </body>
    </html>
    ";

    $headersAdmin  = "MIME-Version: 1.0\r\n";
    $headersAdmin .= "Content-type:text/html;charset=UTF-8\r\n";
    $headersAdmin .= "From: Website <$fromEmail>\r\n";

    // =========================
    // SEND BOTH EMAILS
    // =========================
    $userMail  = mail($toUser, $subjectUser, $messageUser, $headersUser);
    $adminMail = mail($toAdmin, $subjectAdmin, $messageAdmin, $headersAdmin);

    if ($userMail && $adminMail) {
        header("Location: thank-you.php");
        exit;
    } else {
        echo "Error: Email not sent.";
    }

} else {
    echo "Invalid Request.";
}
?>