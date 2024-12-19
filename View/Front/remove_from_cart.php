<?php
require_once 'C:/xampp/htdocs/projet_adam_final/Controller/panierController.php';

$panierController = new PanierController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id !== null) {
        $panierController->removeFromPanier($id);
    }
}

header('Location: panier12.php');
exit;
?>
