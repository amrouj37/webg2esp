<?php
require_once 'C:/xampp/htdocs /projet_sarra/Model/Quiz.php';  // Inclure le modèle Quiz
require_once 'C:/xampp/htdocs /projet_sarra/Controller/QuizController.php'; // Inclure le contrôleur QuizController

// Récupérer les données du formulaire
$id_quiz = $_POST['id_quiz'];             // Nom du quiz
$description = $_POST['description'];       // Description du quiz
$categorie = $_POST['categorie'];           // Catégorie du quiz
$titre = $_POST['titre'];     // titre de quiz
$date_creation = $_POST['date_creation'];   // Date de création du quiz

// Créer un objet quiz1 en passant les paramètres récupérés au constructeur
$quiz1 = new Quiz($id_quiz, $description, $categorie, $titre, $date_creation);

// Afficher les informations de l'objet avec var_dump()
echo "<h2>Informations du Quiz avec var_dump :</h2>";
var_dump($quiz1);

// Créer une instance du contrôleur QuizController
$quizController = new QuizController();

// Appeler la méthode showQuiz() pour afficher les informations de l'objet
echo "<h2>Informations du Quiz (Méthode show) :</h2>";
$quiz1->show(); // Méthode définie dans la classe Quiz pour afficher les informations

// Ajouter le quiz à la base de données via le contrôleur
$quizController->addQuiz($quiz1);

// Afficher un message pour confirmer l'ajout
echo "<p>Le quiz a été ajouté avec succès à la base de données.</p>";
?>
