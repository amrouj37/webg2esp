<?php
//ob_start(); // Commencer le tampon de sortie
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerQuiz.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Quiz.php';

// Instanciation du contrôleur
$ControllerQuiz = new ControllerQuiz();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre = $_POST['titre'] ?? null;
    $description = $_POST['description'] ?? null;
    $date_creation = $_POST['date_creation'] ?? null; 
    $categorie = $_POST['categorie'] ?? null;
  

    // Validation des données (exemple simple)
    if ($titre && $description && $date_creation && $categorie ) {
        if ($ControllerQuiz->ajout($titre, $description, $date_creation, $categorie)) {
            // Redirection vers la page liste des cours
            header("Location: liste.php");
            exit(); // Arrête l'exécution après la redirection
        } else {
            echo "Erreur lors de l'ajout du cours.";
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Quiz</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez le titre" >
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Entrez la catégorie" >
            </div>

            <div class="form-group">
                <label for="date_creation">Date de Création</label>
                <input type="date" class="form-control" id="date_creation" name="date_creation" >
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="3" ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Optional: Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
