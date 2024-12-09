<?php
require_once '../config.php'; // Inclure la configuration de la base de données
require_once '../model/user.php'; 
// Démarrer ou reprendre la session
session_start();

// Vérifier si l'utilisateur est connecté via un cookie ou une session
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_session'])) {
    $user_session = $_COOKIE['user_session'];

    try {
        // Rechercher l'utilisateur dans la base de données grâce au cookie
        $sql = "SELECT id_user, prenom_user, email_user, role_user FROM user WHERE session_token = :session_token";
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->execute([':session_token' => $user_session]);

        // Si un utilisateur est trouvé, restaurer ses informations dans la session
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['prenom_user'] = $user['prenom_user'];
            $_SESSION['email_user'] = $user['email_user'];
            $_SESSION['role_user'] = $user['role_user'];
        } else {
            // Si le token est invalide, supprimer le cookie
            setcookie('user_session', '', time() - 3600, '/');
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
    }
}





?>
