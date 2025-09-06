<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = html_entity_decode(trim($_POST["message"]));
    $mail = new PHPMailer(true);

    try {
        // SMTP server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact.pawsitiveWhispers@gmail.com';
        $mail->Password   = 'vedf zuzk lyen dojh';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('contact.pawsitiveWhispers@gmail.com');

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Message from Pawsitive Whispers';
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();

        header("Location: ../view/Homepage.html?status=success");
    } catch (Exception $e) {
        header("Location: ../view/Homepage.html?status=error");
    }
} else {
    header("Location: ../view/Homepage.html?status=invalid");
}
