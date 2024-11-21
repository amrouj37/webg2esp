<?php
// Inclure le fichier contenant la classe QuizController
require_once 'C:/xamppp/htdocs /projet_sarra//Controller/QuizController.php'; // Chemin vers le contrôleur QuizController

// Vérifier si la méthode HTTP est POST (soumission du formulaire)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées via le formulaire
    $newQuiz = [
        'id_quiz' => $_POST['id_quiz'],          // Nom du quiz
        'description' => $_POST['description'],    // Description du quiz
        'categorie' => $_POST['categorie'],        // Catégorie du quiz
        'titre' => $_POST['titre'],  // titre de quiz
        'date_creation' => $_POST['date_creation'],// Date de création du quiz
    ];

    // Créer une instance du contrôleur QuizController
    $quizController = new QuizController();

    // Appeler la méthode addQuiz pour insérer le quiz dans la base de données
    $quizController->addQuiz($newQuiz);

    // Afficher un message pour confirmer l'ajout réussi
    echo "Le quiz a été ajouté avec succès dans la base de données.";
}
?>
