<?php
// Include database connection
require_once '../Config.php';
$connection = conn::getConnexion();

// Check if the form is submitted and the id is present
if (isset($_POST['id_commande'], $_POST['adresse_livraison'], $_POST['adresse_facturation'])) {
    $id_commande = $_POST['id_commande'];
    $adresse_livraison = $_POST['adresse_livraison'];
    $adresse_facturation = $_POST['adresse_facturation'];

    // Update the order in the database
    $query = "UPDATE commande SET adresse_livraison = :adresse_livraison, adresse_facturation = :adresse_facturation WHERE id_commande = :id_commande";
    $stmt = $connection->prepare($query);

    // Execute the update query
    $stmt->execute([
        'adresse_livraison' => $adresse_livraison,
        'adresse_facturation' => $adresse_facturation,
        'id_commande' => $id_commande
    ]);

    // Redirect to the order list or success page
    header("Location:../View/index.php"); // Or to a success message page
    exit();
} else {
    echo "Invalid request!";
}
?>
