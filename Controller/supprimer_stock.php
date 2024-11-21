
<?php
include_once '../controller/stock.php';
$stock=new stockC();
$stock->supprimer($_GET["nom_produit"]);
header('location:../View/index.php');
?>