<?php
require_once 'C:/xampp/htdocs /projet_sarra/Controller/QuizController.php';  // Inclure le fichier du contrôleur Quiz

// Vérifier si un ID a été passé via les paramètres GET
if (isset($_GET['id_quiz'])) {
    // Récupérer l'ID du quiz depuis l'URL
    $quizId = $_GET['id_quiz'];

    // Créer une instance du contrôleur
    $quizController = new QuizController();

    // Appeler la méthode pour supprimer le quiz
    $quizController->deleteQuiz($quizId);

    // Rediriger l'utilisateur vers la liste des quizzes après suppression
    header('Location: listQuizzes.php');
    exit;
} else {
    // Si aucun ID n'a été fourni, afficher un message d'erreur ou rediriger
    echo "Erreur : aucun ID de quiz fourni.";
}
?>
