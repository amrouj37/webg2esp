<?php
include 'C:\xamppp\htdocs\projetsarra\controller\ControllerQuiz.php';

// Instancier le controller
$ControllerQuiz = new ControllerQuiz();
$list = $ControllerQuiz->getAllQuiz();

// Définir les en-têtes pour l'exportation Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=liste_quiz.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Vérifier si des données sont disponibles
if (!empty($list)) {
    echo "<table border='1'>";
    echo "<thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de Création</th>
                <th>Catégorie</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach ($list as $quiz) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($quiz['titre']) . "</td>";
        echo "<td>" . htmlspecialchars($quiz['description']) . "</td>";
        echo "<td>" . htmlspecialchars($quiz['date_creation']) . "</td>";
        echo "<td>" . htmlspecialchars($quiz['categorie']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucun quiz trouvé.";
}
?>
