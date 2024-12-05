<?php
require_once 'C:\xamppp\htdocs\projetsarra\model\Quiz.php';
require_once 'C:\xamppp\htdocs\projetsarra\Config.php';

class ControllerQuiz {
    private $categorie;
    private $titre;
    private $description;
    private $date_creation;

    public function __construct() {
        $this->model = new Quiz();
    }

    public function getAllQuiz() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM quiz";
        try {
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des quizs : " . $e->getMessage());
        }
    }

    public function ajout($titre, $description, $date_creation, $categorie) {
        try {
            // Connexion à la base de données
            $conn = Config::getConnexion();
    
            // Préparation de la requête SQL
            $sql = "INSERT INTO quiz (titre, description, date_creation, categorie) 
                    VALUES (:titre, :description, :date_creation, :categorie)";
            
            $stmt = $conn->prepare($sql);
    
            // Exécution de la requête avec les valeurs sécurisées
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':date_creation' => $date_creation,
                ':categorie' => $categorie,
            ]);
    
            return true; // Retourne vrai si l'ajout est réussi
        } catch (Exception $e) {
            // Gérer les erreurs
            echo 'Erreur lors de l\'ajout du quiz : ' . $e->getMessage();
            return false;
        }
    }

    public function deleteQuiz($id_quiz) {
        try {
            return $this->model->supprimer($id_quiz);  // Call the delete method from the Quiz model
        } catch (Exception $e) {
            // Handle any errors that occur in the model
            echo 'Erreur lors de la suppression du quiz : ' . $e->getMessage();
            return false;
        }
    }
    

    function getQuizById($id_quiz) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM quiz WHERE id_quiz = :id_quiz";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du quiz : " . $e->getMessage());
        }
    }

    function modifier($quiz, $idc) {
        if (!$quiz) {
            throw new Exception("L'objet quiz est invalide ou manquant.");
        }

        try {
            $conn = config::getConnexion();
    
            // Préparation de la requête SQL
            $query = $conn->prepare(
                'UPDATE quiz SET 
                    titre = :titre,
                    description = :description,
                    categorie = :categorie,
                    date_creation = :date_creation
                WHERE id_quiz = :id_quiz'
            );
    
            $query->execute([
                'id_quiz' => $idc,
                'titre' => $quiz->gettitre(),
                'description' => $quiz->getdescription(),
                'categorie' => $quiz->getcategorie(),
                'date_creation' => $quiz->getdate_creation(),
            ]);

            $affectedRows = $query->rowCount();

            if ($affectedRows > 0) {
                echo "$affectedRows enregistrement(s) mis à jour avec succès.<br>";
            } else {
                echo "Aucune ligne mise à jour. Vérifiez l'ID ou les données fournies.<br>";
            }

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }



    public function exportToExcel() {
        $list = $this->getAllQuiz(); // Récupère tous les quizzes depuis la méthode existante
    
        // Définir les en-têtes pour l'exportation Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=liste_quiz.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    
        // Vérifier si des données sont disponibles
        if (!empty($list)) {
            echo "<table border='1'>"; // Début du tableau HTML
            echo "<thead>
                    <tr>
                        <th>ID Quiz</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date de Création</th>
                        <th>Catégorie</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            
            // Boucle pour afficher chaque quiz dans une ligne
            foreach ($list as $quiz) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($quiz['id_quiz']) . "</td>";
                echo "<td>" . htmlspecialchars($quiz['titre']) . "</td>";
                echo "<td>" . htmlspecialchars($quiz['description']) . "</td>";
                echo "<td>" . htmlspecialchars($quiz['date_creation']) . "</td>";
                echo "<td>" . htmlspecialchars($quiz['categorie']) . "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>"; // Fin du tableau HTML
        } else {
            echo "Aucun quiz trouvé."; // Message si aucune donnée n'est disponible
        }
    }
}    
?>
