<?php
require_once 'C:/xampp/htdocs/projectA/View/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'C:/xampp/htdocs/projectA/View/vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'C:/xampp/htdocs/projectA/View/vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendConfirmationEmail($email, $name) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nourkhaled2430@gmail.com'; // Votre adresse email
        $mail->Password = 'phrg ujvh jgdg mdok'; // Remplacez par un mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('nourkhaled2430@gmail.com', 'GREEN BITS');
        $mail->addAddress($email);
        $mail->Subject = "Bienvenue chez GREEN BITS";
        $mail->Body = "Bonjour $name,\n\nVotre inscription a été effectuée avec succès !\n\nBienvenue dans notre communauté.\n\nCordialement,\nL'équipe GREEN BITS.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo);
        return false;
    }
}
?>