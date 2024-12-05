<?php
include 'C:\xamppp\htdocs\projetsarra\controller\ControllerQuiz.php';

$ControllerQuiz = new ControllerQuiz();
$list = $ControllerQuiz->getAllQuiz();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=liste_quiz.xls");
header("Pragma: no-cache");
header("Expires: 0");

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
        echo "<td>" . htmlspecialchars($categorie['categorie']) . "</td>";

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucun cours trouvé.";
}
?>