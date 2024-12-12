<?php
// supprimer.php
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php';  // Include your controller
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';  // Include your Pack model

// Create an instance of ControllerPack
$ControllerPack = new ControllerPack();

// Check if the 'id_Pack' is provided in the URL
if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
    $id_pack = (int)$_GET['id_pack'];  // Ensure the id_Pack is an integer

    // Call the deletePack method from ControllerPack
    $deleteSuccess = $ControllerPack->deletepack($id_pack);

    if ($deleteSuccess) {
        // If deletion was successful, redirect to the Pack list page
        header('Location: index.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la suppression du Pack.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID du Pack manquant ou invalide.</div>";
    exit;
}

?>
