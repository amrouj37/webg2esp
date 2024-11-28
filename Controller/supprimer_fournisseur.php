
<?php
include_once '../controller/fournisseur.php';
$stock=new fournisseurC();
$stock->supprimer($_GET["id_fournisseur"]);
header('location:../View/index.php');
?>