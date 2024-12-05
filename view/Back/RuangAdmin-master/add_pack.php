<?php
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new ControllerPack();
    $controller->add_Pack($_POST['nom_utilisateur'], $_POST['contenu'], $_POST['date_soumission'], $_POST['categorie']);
    header("Location: liste_pack.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Pack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Ajouter un Pack</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nom_utilisateur" class="form-label">Nom Utilisateur</label>
            <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" required>
        </div>
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="date_soumission" class="form-label">Date de Soumission</label>
            <input type="date" class="form-control" id="date_soumission" name="date_soumission" required>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
</body>
</html>
