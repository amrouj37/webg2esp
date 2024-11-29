<?php
require_once '../Config.php';
require_once '../controller/commandecontroller.php';

if (isset($_GET['id'])) {
    $commandeController = new CommandeController();
    $commande = $commandeController->getCommandeById($_GET['id']);

    if ($commande) {
        echo "<h1>Commande Details</h1>";
        echo "<p>ID Commande: " . $commande['id_commande'] . "</p>";
        echo "<p>Date Commande: " . $commande['date_commande'] . "</p>";
        echo "<p>Adresse Livraison: " . $commande['adresse_livraison'] . "</p>";
        echo "<p>Adresse Facturation: " . $commande['adresse_facturation'] . "</p>";
    } else {
        echo "Commande not found.";
    }
} else {
    echo "No ID specified.";
}
?>
