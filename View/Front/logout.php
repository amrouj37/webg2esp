<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; // Chemin vers le fichier de configuration

session_start();

// Récupérer le nom de l'utilisateur avant de détruire la session (si défini)
$prenom_user = isset($_SESSION['prenom_user']) ? $_SESSION['prenom_user'] : '';

// Réinitialiser et détruire la session
$_SESSION = [];
unset($_SESSION['key']);
session_unset();
session_destroy();

// Redirection vers la page de connexion avec le nom de l'utilisateur en paramètre
header("Location: login.php?prenom_user=" . urlencode($prenom_user));
exit();
?>