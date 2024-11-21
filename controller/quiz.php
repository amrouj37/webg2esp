<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\projet_sarra\config.php'; 
require_once 'Quiz.php'; // Remplacez par le modèle Quiz si nécessaire

class QuizController {
    // Récupérer tous les quiz
    public function getQuiz() {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "SELECT * FROM quiz";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute(); // Exécution de la requête
            return $query->fetchAll(); // Retourne tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Ajouter un quiz
    public function addQuiz($quiz) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "INSERT INTO quiz (Titre, Description, Date_creation, Categorie) 
                VALUES (:Titre, :Description, :Date_creation, :Categorie)";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([
                ':Titre' => $quiz['Titre'],
                ':Description' => $quiz['Description'],
                ':Date_creation' => $quiz['Date_creation'],
                ':Categorie' => $quiz['Categorie']
            ]); // Exécution avec les valeurs du nouvel enregistrement
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Mettre à jour un quiz
    public function updateQuiz($id, $quiz) {
        $conn = config::getConnexion();
        $sql = "UPDATE quiz 
                SET Titre = :Titre, 
                    Description = :Description, 
                    Date_creation = :Date_creation, 
                    Categorie = :Categorie 
                WHERE id = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':Titre' => $quiz['Titre'],
                ':Description' => $quiz['Description'],
                ':Date_creation' => $quiz['Date_creation'],
                ':Categorie' => $quiz['Categorie']
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Supprimer un quiz
    public function deleteQuiz($id) {
        $conn = config::getConnexion();
        $sql = "DELETE FROM quiz WHERE id = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Récupérer un quiz par ID
    public function getQuizById($id) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM quiz WHERE id = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
            return $query->fetch(); // Retourne une seule ligne
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
}
?>
