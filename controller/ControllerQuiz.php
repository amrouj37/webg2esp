

<?php
require_once 'C:/xamppp/htdocs/projetsarra/model/Quiz.php';
require_once 'C:/xamppp/htdocs/projetsarra/config.php';

class ControllerQuiz {
    public function __construct() {
        $this->model = new Quiz();
    }

    // Fetch all quizzes
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

    // Add a new quiz
    public function addQuiz($titre, $description, $date_creation, $categorie) {
        try {
            $conn = Config::getConnexion();

            $sql = "INSERT INTO quiz (titre, description, date_creation, categorie) 
                    VALUES (:titre, :description, :date_creation, :categorie)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':date_creation' => $date_creation,
                ':categorie' => $categorie,
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Erreur lors de l\'ajout du quiz : ' . $e->getMessage();
            return false;
        }
    }

    // Delete a quiz by its ID (Directly in the controller, no need to call model)
    public function deleteQuiz($id_quiz) {
        try {
            $conn = config::getConnexion();
            $sql = "DELETE FROM quiz WHERE id_quiz = :id_quiz";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo 'Erreur lors de la suppression du quiz : ' . $e->getMessage();
            return false;
        }
    }

    // Search quiz by title
    public function searchQuizByTitle($title) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM quiz WHERE titre LIKE :title";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':title', "%" . $title . "%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Update a quiz
    public function modifier($quiz, $id_quiz) {
        // Vérifiez si l'objet quiz est valide
        if (!$quiz || empty($id_quiz)) {
            throw new Exception("L'objet quiz ou l'identifiant du quiz est invalide ou manquant.");
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
    
            // Vérification et récupération des données de l'objet Quiz
            $titre = $quiz->getTitre(); // Corrigé avec le bon nom de méthode
            $description = $quiz->getDescription();
            $categorie = $quiz->getCategorie();
            $date_creation = method_exists($quiz, 'getDateCreation') ? $quiz->getDateCreation() : null; // Vérifie si la méthode existe
    
            // Vérifiez si la méthode getDateCreation est manquante
            if ($date_creation === null) {
                throw new Exception("La méthode 'getDateCreation' est introuvable ou retourne une valeur nulle.");
            }
    
            // Exécution de la requête
            $query->execute([
                ':id_quiz' => $id_quiz,
                ':titre' => $titre,
                ':description' => $description,
                ':categorie' => $categorie,
                ':date_creation' => $date_creation
            ]);
    
            // Vérifiez combien de lignes ont été affectées
            $affectedRows = $query->rowCount();
    
            if ($affectedRows > 0) {
                echo "$affectedRows enregistrement(s) mis à jour avec succès.<br>";
            } else {
                echo "Aucune ligne mise à jour. Vérifiez l'ID ou les données fournies.<br>";
            }
    
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    
    }

    // Export quizzes to Excel
   