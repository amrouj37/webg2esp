<?php
require_once '../Config.php';
require_once '../controller/paniercontroller.php'; // Use relative paths

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $panier = [
        'quantite' => $_POST['quantite'],
        'prix_unitaire' => $_POST['prix_unitaire'],
        'date_ajout' => $_POST['date_ajout'],
    ];
    
    // Instantiate the controller
    $panierController = new PanierController();
    
    // Add panier to the database
    $panierController->addPanier($panier);

    // Redirect to the panier page after successful insertion
    header('Location: ../view/RuangAdmin-master/simple-tables.php');
    exit;
}
