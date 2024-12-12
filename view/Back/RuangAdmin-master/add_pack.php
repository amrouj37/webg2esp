<?php
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';

// Initialize the controller
$controllerPack = new ControllerPack();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $contenu = $_POST['contenu'];
    $date_soumission = $_POST['date_soumission'];
    $categorie = $_POST['categorie'];
    $id_quiz = $_POST['id_quiz']; // Get the quiz ID from the form

    // Debugging: Check the value of id_quiz
    echo "Valeur de id_quiz : " . htmlspecialchars($id_quiz); // Pour vérifier si l'id_quiz est bien soumis

    // Call the addPack method
    $controllerPack->addPack($nom_utilisateur, $contenu, $date_soumission, $categorie, $id_quiz);

    // Redirect to another page after successful submission (for example, back to the list page)
    header("Location: index.php"); // You can change this URL to any page you want to redirect to
    exit(); // Make sure the script stops after redirection
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
    <form method="POST" action="add_pack.php">
        <div class="form-group">
            <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" name="nom_utilisateur" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu</label>
            <input type="text" name="contenu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date_soumission">Date de Soumission</label>
            <input type="date" name="date_soumission" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_quiz">ID Quiz</label>
            <input type="number" name="id_quiz" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Pack</button>
    </form>
</div>
</body>
</html>
