<?php
require_once '../controller/userC.php';  

// Créer une instance de UserController
$userController = new UserController();

// Récupérer tous les utilisateurs
$users = $userController->getUser();
?>