<?php
class QuizController {
    public function showQuiz($quiz) {
        echo "<table border='1'>"; // Table avec une bordure pour un affichage clair
        echo "<tr><th>Titre</th><th>Description</th><th>Date de Création</th><th>Catégorie</th></tr>"; // En-tête des colonnes
        echo "<tr>";
        echo "<td>{$quiz->Titre}</td>"; // Affichage du titre
        echo "<td>{$quiz->Description}</td>"; // Affichage de la description
        echo "<td>{$quiz->Date_creation}</td>"; // Affichage de la date de création
        echo "<td>{$quiz->Categorie}</td>"; // Affichage de la catégorie
        echo "</tr>";
        echo "</table>";
    }
}
?>
