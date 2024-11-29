<?php require_once 'C:\xamppp\htdocs\projetsarra\Config.php';
require_once 'C:\xamppp\htdocs\projetsarra\controller\ControllerQuizz.php';
require_once 'C:\xamppp\htdocs\projetsarra\model\Quizz.php'; // Inclure la classe Cours si elle est définie ailleurs

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

// Récupérez les détails du cours par ID
$list = $ControllerQuiz->getAllquiz();
$pr = null;

foreach ($list as $row) {
    if ($row['id_quiz'] == $id_quiz) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Cours introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titre"]) && isset($_POST["description"]) &&
        isset($_POST["categorie"]) && isset($_POST["date_creation"]) 
       
    ) {
        // Instanciez l'objet cours avec les données soumises
        $quiz = new quiz(
            $_POST['titre'],
            $_POST['description'],
            $_POST['categorie'],
            $_POST['date_creation'],
            
        );

        // Appelez la méthode de mise à jour
        $ControllerQuiz->modifier($quiz, $id_quiz);
        header("Location: liste.php");
        exit;

    } else {
        $error = "Des informations sont manquantes.";
    }
}
?>