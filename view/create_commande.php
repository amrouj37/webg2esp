<?php
require_once '../Config.php';
require_once '../controller/commandecontroller.php'; // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data (make sure these fields are in your form)
    $commande = [              
        'date_commande' => $_POST['date_commande'],      // Order date
        'adresse_livraison' => $_POST['adresse_livraison'], // Delivery address
        'adresse_facturation' => $_POST['adresse_facturation'], // Billing address
    ];
    
    // Instantiate the CommandeController
    $commandeController = new CommandeController();
    
    // Add commande to the database
    $commandeController->addCommande($commande);

    // Redirect to the page where you can view the list of commandes after successful insertion
    header('Location: ../view/RuangAdmin-master/simple-tables.php');
    exit;
}
?>
