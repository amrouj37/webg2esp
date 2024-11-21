<?php
require_once 'C:\xampp\htdocs\ABABA\controller\paniercontroller.php';  // Adjust the path as needed

// Check if the 'id' parameter exists in the query string
if (isset($_GET['id'])) {
    // Retrieve the ID to delete
    $panier = $_GET['id'];

    // Create an instance of PanierController
    $paniercontroller = new PanierController();

    // Call the delete method to remove the record
    $paniercontroller->deletePanier($panier);

    // Redirect to the page showing the list of records
    header('Location: ../view/RuangAdmin-master/simple-tables.php');
    exit;
} else {
    // If no 'id' is provided, redirect back with an error message
    header('Location: ./view/RuangAdmin-master/simple-tables.php?error=MissingID');
    exit;
}
?>
