<?php
require_once '../Config.php';
require_once '../controller/paniercontroller.php';
include '../view/fonctionp.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Panier</title>
    <link rel="stylesheet" href="C:\xampp\htdocs\ABABA\view\create_panier.css">
    <title>RuangAdmin - Simple Tables</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Create New Panier</h2>
        <form action="../view/fonctionp.php" method="POST">
            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" id="quantite" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Prix Unitaire:</label>
                <input type="text" name="prix_unitaire" id="prix_unitaire" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_ajout">Date Ajout:</label>
                <input type="date" name="date_ajout" id="date_ajout" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Panier</button>
            <a href="panier.html" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
