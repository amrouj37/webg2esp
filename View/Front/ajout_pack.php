<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\packC.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\pack.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = trim($_POST['type']);
    if (!empty($type)) {
        $pack = new Pack($type);
        $packC = new PackC();
        $packC->addpacks($pack);

        // Rediriger vers l'index après ajout
        header('Location: index.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Veuillez sélectionner un type de pack.</div>";
    }
}
?>
