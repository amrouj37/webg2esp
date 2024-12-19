<?php
// Include database connection
require_once 'C:\xampp\htdocs\projet_adam_final\config.php';
$connection = conn::getConnexion();

// Check if we have an id parameter in the URL
if (isset($_GET['id'])) {
    $id_commande = $_GET['id'];

    // Prepare the delete query
    $query = "DELETE FROM commande WHERE id_commande = :id_commande";
    $stmt = $connection->prepare($query);

    // Execute the delete query
    $stmt->execute(['id_commande' => $id_commande]);

    // Redirect to the commandes list or success page
    header("Location: ../View/index.php"); // Or to a success message page
    exit();
} else {
    echo "Invalid request!";
}
?>
