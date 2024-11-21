<?php
require_once 'PlatController.php'; // Path to your controller file

$controller = new PlatController();

// Test: Add a new plat
$newPlat = [
    'nom_plat' => 'Spaghetti Bolognese',
    'prix_plat' => 12.500,
    'id_recette' => 1
];
$controller->addPlat($newPlat);
echo "Plat ajouté avec succès!<br>";

// Test: Get all plats
$plats = $controller->getPlats();
echo "Liste des plats : <br>";
foreach ($plats as $plat) {
    echo "ID: {$plat['id_plat']}, Nom: {$plat['nom_plat']}, Prix: {$plat['prix_plat']}, Recette ID: {$plat['id_recette']}<br>";
}

// Test: Update a plat
$updatedPlat = [
    'nom_plat' => 'Pizza Margherita',
    'prix_plat' => 8.990,
    'id_recette' => 2
];
$controller->updatePlat(1, $updatedPlat);
echo "Plat mis à jour avec succès!<br>";

// Test: Get a plat by ID
$plat = $controller->getPlatById(1);
echo "Plat récupéré: ID: {$plat['id_plat']}, Nom: {$plat['nom_plat']}, Prix: {$plat['prix_plat']}, Recette ID: {$plat['id_recette']}<br>";

// Test: Delete a plat
$controller->deletePlat(1);
echo "Plat supprimé avec succès!<br>";

// Verify deletion
$plats = $controller->getPlats();
echo "Liste des plats après suppression : <br>";
foreach ($plats as $plat) {
    echo "ID: {$plat['id_plat']}, Nom: {$plat['nom_plat']}, Prix: {$plat['prix_plat']}, Recette ID: {$plat['id_recette']}<br>";
}
?>