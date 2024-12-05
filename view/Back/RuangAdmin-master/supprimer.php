<?php
// supprimer.php
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerQuiz.php';  // Include your controller
require_once 'C:\xamppp\htdocs\projetsarra\model\Quiz.php';  // Include your Quiz model

// Create an instance of ControllerQuiz
$ControllerQuiz = new ControllerQuiz();

// Check if the 'id_quiz' is provided in the URL
if (isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])) {
    $id_quiz = (int)$_GET['id_quiz'];  // Ensure the id_quiz is an integer

    // Call the deleteQuiz method from ControllerQuiz
    $deleteSuccess = $ControllerQuiz->deleteQuiz($id_quiz);

    if ($deleteSuccess) {
        // If deletion was successful, redirect to the quiz list page
        header('Location: liste.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la suppression du quiz.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID du quiz manquant ou invalide.</div>";
    exit;
}

?>
