<?php
// File: add_to_cart.php
include 'C:/xampp/htdocs/projet_adam_final/Controller/panierController.php';
$panierController = new PanierController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produitName = $_POST['produit'] ?? '';
    if ($produitName) {
        $panierController->addToPanier($produitName);
    }
}
header('Location: client.php');
exit;

// View: panier.php
?>