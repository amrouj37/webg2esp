<?php
require_once '../Config.php';
require_once '../controller/commandecontroller.php';

if (isset($_GET['id'])) {
    $commandeId = $_GET['id'];

    $commandeController = new CommandeController();
    $commandeController->deleteCommande($commandeId);

    header('Location: ./view/RuangAdmin-master/simple-tables.php?error=MissingID');
    exit;
}
?>
