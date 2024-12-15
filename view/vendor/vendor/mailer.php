<?php

// Inclure PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

// Récupérer l'email envoyé par POST
$email = $_POST["email"];

try {
    // Générer un token aléatoire et son hachage
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);

    // Définir la date d'expiration (30 minutes à partir de maintenant)
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    // Connexion PDO
    require __DIR__ . "/database.php"; // Inclure la connexion PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mettre à jour le jeton de réinitialisation et son expiration
    $sql = "UPDATE user 
            SET reset_token_hash = :reset_token_hash, 
                reset_token_expires_at = :reset_token_expires_at 
            WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reset_token_hash', $token_hash, PDO::PARAM_STR);
    $stmt->bindParam(':reset_token_expires_at', $expiry, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Vérifier si un utilisateur a été trouvé et mis à jour
    if ($stmt->rowCount() > 0) {
        // Configuration de PHPMailer
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.example.com"; // Configurer l'hôte SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "your-user@example.com"; // Votre nom d'utilisateur SMTP
        $mail->Password = "your-password"; // Votre mot de passe SMTP

        $mail->setFrom("noreply@example.com", "Support"); // Adresse de l'expéditeur
        $mail->addAddress($email); // Destinataire

        $mail->Subject = "Password Reset";
        $mail->isHTML(true);
        $mail->Body = <<<EOT
        Click <a href="http://example.com/reset-password.php?token=$token">here</a> 
        to reset your password.
        EOT;

        try {
            $mail->send();
            echo "An email has been sent to reset your password.";
        } catch (Exception $e) {
            echo "Mailer error: " . $mail->ErrorInfo;
        }
    } else {
        echo "No user found with this email.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General error: " . $e->getMessage();
}
