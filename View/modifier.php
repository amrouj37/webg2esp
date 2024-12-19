<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\quizC.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\quiz.php';

$error = "";

// Instanciation du contrôleur
$QuizC = new QuizC();

// Vérifiez que l'ID est défini dans $_GET
if (isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])) {
    $id_quiz = (int)$_GET['id_quiz']; // Convertir l'ID en entier
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit; // Arrêtez l'exécution si l'ID est manquant ou invalide
}

// Récupérez les détails du quiz par ID
$list = $QuizC->getAllQuizs(); // Fixed the function name to getAllQuiz
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
        isset($_POST["sexe"]) && isset($_POST["age"]) &&
        isset($_POST["poids"]) && isset($_POST["niveau_activite"]) && isset($_POST["but"])
    ) {
        // Appelez la méthode de mise à jour en passant les 6 arguments séparés
        $QuizC->updateQuiz(
            $id_quiz,  // L'ID du quiz
            $_POST['sexe'], 
            $_POST['age'],
            $_POST['poids'],
            $_POST['niveau_activite'],
            $_POST['but']
        );
        header("Location: index.php"); // Redirect after updating
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
    <title>updateQuiz un Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">updateQuiz un Quiz</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="sexe">sexe</label>
                <input type="text" class="form-control" id="sexe" name="sexe" value="<?= htmlspecialchars($pr['sexe']) ?>" placeholder="Entrez le sexe" required>
            </div>

            <div class="form-group">
                <label for="age">age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($pr['age']) ?>" placeholder="Entrez la catégorie" required>
            </div>
            <div class="form-group">
                <label for="poids">poids</label>
                <input type="number" class="form-control" id="poids" name="poids" value="<?= htmlspecialchars($pr['poids']) ?>" placeholder="Entrez la catégorie" required>
            </div>

            <div class="form-group">
                <label for="niveau_activite">niveau_activité</label>
                <input type="text" class="form-control" id="niveau_activite" name="niveau_activite" value="<?= htmlspecialchars($pr['niveau_activite']) ?>" required>
            </div>

            <div class="form-group">
                <label for="but">but</label>
                <textarea class="form-control" id="but" name="but" placeholder=" but" rows="3" required><?= htmlspecialchars($pr['but']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">updateQuiz</button>
        </form>
    </div>

    <!-- Optional: Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
