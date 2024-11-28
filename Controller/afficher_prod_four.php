<?php

session_start();
include_once 'C:/xampp/htdocs/projet_adam_final/Controller/stock.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);


$stockC = new stockC();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true)); 

    if (isset($_POST["choix"]) ) {
        $id_fournisseur = $_POST["choix"]; 

        
        $list = $stockC->afficherProduit($id_fournisseur);
    
        $_SESSION['list'] = $list;
        //echo $id_fournisseur;
        // Debug output (optional)
        //error_log(print_r($list, true));
        error_log("Debug: List returned = " . print_r($list, true));
        
}

       header('location:../View/index.php');
    } 

?>
