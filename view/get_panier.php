<?php
require_once '../Config.php';
require_once '../../paniercontroller.php';

// Initialize the PanierController
$panierController = new PanierController();

// Fetch all records
$paniers = $panierController->getPaniers();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($paniers);
?>
