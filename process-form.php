<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate data
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    // Additional validation if needed
    if (empty($name) || empty($email) || empty($message)) {
        // Handle validation errors (redirect or display an error message)
        header("Location: error.html");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format (redirect or display an error message)
        header("Location: error.html");
        exit;
    }

    // Set recipient email address
    $to = "chinakageorge.i@gmail.com";
    $subject = "New Form Submission";
    $headers = "From: $email";

    // Mail content
    $mailContent = "Name: $name\n";
    $mailContent .= "Email: $email\n";
    $mailContent .= "Message:\n$message";

    // Send email
    mail($to, $subject, $mailContent, $headers);

    // Redirect or display a thank you message
    header("Location: thank-you.html");
    exit;
}
?>
