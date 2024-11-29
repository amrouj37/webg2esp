<?php
require_once '../Config.php'; // Make sure to include the configuration
require_once '../controller/commandecontroller.php'; // Include the CommandeController

// Initialize the CommandeController
$commandeController = new CommandeController();

// Fetch all commandes
$commandes = $commandeController->getCommandes(); // Get all commandes from the database

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($commandes); // Convert the array of commandes to JSON and output
?>
