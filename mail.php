<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seanepalesa01@gmail.com';
        $mail->Password = 'cglp ykgz jhsh yybb'; // Use App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('seanepalesa01@gmail.com'); // ✅ Send to yourself

        $mail->isHTML(true);
        $mail->Subject = "Contact Form Message from $name | ID " . time();
        $mail->Body = "
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
            <hr>
            <p>Sent from Palesa's Portfolio</p>
        ";

        $mail->send();

        echo json_encode(['status' => 'ok', 'msg' => 'Message Sent Successfully.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'msg' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Invalid form submission.']);
}
