<?php
require_once '../Config.php';
require_once '../controller/paniercontroller.php';

// Retrieve the record to be updated
$panierController = new PanierController();
$id = isset($_GET['id']) ? $_GET['id'] : null;
$panier = $id ? $panierController->getPanierById($id) : null;


// Handle the form submission for updating the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedPanier = [
        'quantite' => $_POST['quantite'],
        'prix_unitaire' => $_POST['prix_unitaire'],
        'date_ajout' => $_POST['date_ajout'],
    ];

    $panierController->updatePanier($_POST['id_panier'], $updatedPanier);

    // Redirect back to the table page
    header('Location: ../view/RuangAdmin-master/simple-tables.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Panier</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Add your CSS file path -->
</head>
<body>
    <div class="container">
        <h2>Update Panier</h2>
        <form action="update_panier.php" method="POST">
            <input type="hidden" name="id_panier" value="<?= $panier['id_panier'] ?>">

            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" id="quantite" value="<?= $panier['quantite'] ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire:</label>
                <input type="text" name="prix_unitaire" id="prix_unitaire" value="<?= $panier['prix_unitaire'] ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_ajout">Date Ajout:</label>
                <input type="date" name="date_ajout" id="date_ajout" value="<?= $panier['date_ajout'] ?>" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Panier</button>
            <a href="../view/RuangAdmin-master/simple-tables.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
