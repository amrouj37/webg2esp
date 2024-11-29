<?php
require_once '../Config.php';
require_once '../controller/commandecontroller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $commandeId = $_GET['id'];
    $commande = [
        'id_client' => $_POST['id_client'],
        'date_commande' => $_POST['date_commande'],
        'adresse_livraison' => $_POST['adresse_livraison'],
        'adresse_facturation' => $_POST['adresse_facturation'],
    ];

    $commandeController = new CommandeController();
    $commandeController->updateCommande($commandeId, $commande);

    header('Location: ../view/read_commande.php');
    exit;
}

// Fetch existing data for the form (if needed)
?>

