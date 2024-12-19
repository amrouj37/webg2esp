<?php
require_once '../controller/panierController.php';

$panierController = new PanierController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $quantite = $_POST['quantite'] ?? null;

    if ($id !== null && $quantite !== null && $quantite > 0) {
        $panierController->updateQuantity($id, $quantite);
    }
}

header('Location: ../view/organic-1.0.0/panierupdate.php');
exit;
?>
