<?php
require_once 'C:\xampp\htdocs\projectA\config.php'; // Inclure la configuration de la base de données
require_once 'C:\xampp\htdocs\projectA\model\user.php'; 

// Démarrer ou reprendre la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Fonction pour déconnecter l'utilisateur.
 */
function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
    // Supprimer le cookie de session si présent
    if (isset($_COOKIE['user_session'])) {
        setcookie('user_session', '', time() - 3600, '/');
    }
    header("Location: login.php");
    exit();
}

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
        // Gestion de l'erreur de connexion ou d'exécution de la requête
        echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
    }
}

// Vérifier si l'utilisateur est toujours connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Récupérer le rôle actuel de l'utilisateur.
 * @return string|null
 */
function getRole() {
    return $_SESSION['role_user'] ?? null;
}

/**
 * Redirige l'utilisateur si son rôle ne correspond pas.
 * @param string $requiredRole
 */
function requireRole($requiredRole) {
    if (getRole() !== $requiredRole) {
        logout(); // Déconnecte et redirige vers la page de login
    }
}
?>
