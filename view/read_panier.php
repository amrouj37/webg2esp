<?php
require_once '../Config.php';
require_once '../paniercontroller.php';

if (isset($_GET['id'])) {
    $panierController = new PanierController();
    $panier = $panierController->getPanierById($_GET['id']);

    if ($panier) {
        echo "<h1>Panier Details</h1>";
        echo "<p>ID: " . $panier['id_panier'] . "</p>";
        echo "<p>Quantité: " . $panier['quantite'] . "</p>";
        echo "<p>Prix Unitaire: " . $panier['prix_unitaire'] . "</p>";
        echo "<p>Date Ajout: " . $panier['date_ajout'] . "</p>";
    } else {
        echo "Panier not found.";
    }
} else {
    echo "No ID specified.";
}
?>
