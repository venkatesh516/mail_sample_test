<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your email address
$to = "venkatesh.c16@gmail.com"; 

// Collect form data
$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$subject  = $_POST['subject'] ?: 'New Contact Form Submission';
$company  = $_POST['company'] ?? '';
$message  = nl2br($_POST['message'] ?? '');

// Email subject line
$email_subject = "Contact Form: $subject";

// HTML email content
$email_body = "
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; }
    .email-container {
      max-width: 600px;
      padding: 20px;
      background: #fffbef;
      border: 1px solid #ddd;
      border-radius: 6px;
    }
    .field-title { font-weight: bold; margin-top: 10px; }
    .field-value { margin-bottom: 10px; }
  </style>
</head>
<body>
  <div class='email-container'>
    <h2>New Contact Form Submission</h2>
    <p><span class='field-title'>Name:</span> $name</p>
    <p><span class='field-title'>Email:</span> $email</p>
    <p><span class='field-title'>Subject:</span> $subject</p>
    <p><span class='field-title'>Company Name:</span> $company</p>
    <p><span class='field-title'>Message:</span><br>$message</p>
  </div>
</body>
</html>
";

// Headers
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Send mail
if (mail($to, $email_subject, $email_body, $headers)) {
  http_response_code(200);
  echo "Message sent successfully.";
} else {
  http_response_code(500);
  echo "Message failed.";
}

