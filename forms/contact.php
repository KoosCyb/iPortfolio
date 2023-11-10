<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill out all the fields.";
        exit;
    }

    // Build the email content
    $to = "koos1985@gmail.com";
    $subject = "New Contact Form Submission: $subject";
    $headers = "From: $name <$email>";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message";

    // Send the email
    mail($to, $subject, $email_content, $headers);

    // Return success message
    http_response_code(200);
    echo "Your message has been sent. Thank you!";
} else {
    // Not a POST request, return an error
    http_response_code(403);
    echo "There was a problem with your submission. Please try again.";
}

?>
