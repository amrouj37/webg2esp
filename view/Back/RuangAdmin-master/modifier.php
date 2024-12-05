<?php
require_once 'C:\xamppp\htdocs\projetsarra\Config.php';
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerQuiz.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Quiz.php';

$error = "";

// Instanciation du contrôleur
$ControllerQuiz = new ControllerQuiz();

// Vérifiez que l'ID est défini dans $_GET
if (isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])) {
    $id_quiz = (int)$_GET['id_quiz']; // Convertir l'ID en entier
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit; // Arrêtez l'exécution si l'ID est manquant ou invalide
}

// Récupérez les détails du quiz par ID
$list = $ControllerQuiz->getAllQuiz(); // Fixed the function name to getAllQuiz
$pr = null;

foreach ($list as $row) {
    if ($row['id_quiz'] == $id_quiz) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Quiz introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titre"]) && isset($_POST["description"]) &&
        isset($_POST["categorie"]) && isset($_POST["date_creation"])
    ) {
        // Instanciez l'objet quiz avec les données soumises
        $quiz = new Quiz(
            null, // The PDO object can be passed here if necessary
            $id_quiz, // Passing the current ID
            $_POST['titre'],
            $_POST['description'],
            $_POST['categorie'],
            $_POST['date_creation']
        );

        // Appelez la méthode de mise à jour
        $ControllerQuiz->modifier($quiz, $id_quiz);
        header("Location: liste.php"); // Redirect after updating
        exit;
    } else {
        $error = "Des informations sont manquantes.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Quiz</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($pr['titre']) ?>" placeholder="Entrez le titre" required>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?= htmlspecialchars($pr['categorie']) ?>" placeholder="Entrez la catégorie" required>
            </div>

            <div class="form-group">
                <label for="date_creation">Date de Création</label>
                <input type="date" class="form-control" id="date_creation" name="date_creation" value="<?= htmlspecialchars($pr['date_creation']) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="3" required><?= htmlspecialchars($pr['description']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Optional: Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
