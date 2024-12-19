<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\quizC.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\quiz.php';

// Instanciation du contrôleur
$QuizC = new QuizC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $sexe = $_POST['sexe'] ?? null;
    $age = $_POST['age'] ?? null;
    $poids = $_POST['poids'] ?? null; 
    $niveau_activite = $_POST['niveau_activite'] ?? null;
    $but = $_POST['but'] ?? null;

    // Validation des données
    if ($sexe && $age && $poids && $niveau_activite && $but) {
        // Création d'un objet Quiz
        $quiz = new Quiz($sexe, $age, $poids, $niveau_activite, $but);

        // Ajout du quiz en utilisant le contrôleur
        try {
            $QuizC->addQuiz($quiz); // Passez l'objet Quiz à la méthode
            header("Location: client.php");
            exit();
        } catch (Exception $e) {
            echo "Erreur lors de l'ajout du quiz: " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
}
?>

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

            <!-- Sexe: Dropdown and Text Input -->
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select class="form-control mb-2" id="sexe" name="sexe">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </div>

            <!-- Age Input -->
            <div class="form-group">
                <label for="age">Âge</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Entrez l'âge">
            </div>

            <!-- Poids Input -->
            <div class="form-group">
                <label for="poids">Poids</label>
                <input type="number" class="form-control" id="poids" name="poids">
            </div>

            <!-- Niveau d'Activité: Dropdown and Textarea -->
            <div class="form-group">
                <label for="niveau_activite">Niveau d'Activité</label>
                <select class="form-control mb-2" id="niveau_activite" name="niveau_activite">
                    <option value="Active">Active</option>
                    <option value="Normale">Normale</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <!-- But: Dropdown and Textarea -->
            <div class="form-group">
                <label for="but">But</label>
                <select class="form-control mb-2" id="but" name="but">
                    <option value="Weight Gain">Weight Gain</option>
                    <option value="Weight Loss">Weight Loss</option>
                </select>
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
