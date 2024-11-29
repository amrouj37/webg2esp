<?php
require_once '../Config.php';
require_once '../controller/paniercontroller.php';

// Initialize the PanierController
$panierController = new PanierController();

// Retrieve the record to be updated
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Fetch panier data by id
    $panier = $panierController->getPanierById($id);

    // Check if the panier was found
    if (!$panier) {
        echo "Panier not found.";
        exit();
    }
} else {
    echo "No ID provided.";
    exit();
}

// Handle the form submission for updating the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the form data for the update
    $updatedPanier = [
        'quantite' => $_POST['quantite'],
        'prix_unitaire' => $_POST['prix_unitaire'],
        'date_ajout' => $_POST['date_ajout'],
    ];

    // Update the panier record in the database
    $panierController->updatePanier($_POST['id_panier'], $updatedPanier);

    // Redirect back to the table page after successful update
    header('Location: ../view/RuangAdmin-master/simple-tables.php');
    exit();
}
?>
