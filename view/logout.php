<?php
require_once '../config.php'; // Inclure la configuration si nécessaire
require_once 'session.php'; // Assurez-vous que le chemin est correct

// Démarrer ou reprendre la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Détruire la session
session_destroy();

// Supprimer le cookie de session si existant
if (isset($_COOKIE['user_session'])) {
    setcookie('user_session', '', time() - 3600, '/'); // Expiration immédiate
}

// Rediriger vers la page de connexion
header("Location: login.php");
exit();
?>
