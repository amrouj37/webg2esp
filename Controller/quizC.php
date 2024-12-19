<?php
require_once 'C:/xampp/htdocs/projet_adam_final/config.php'; 
require_once 'C:/xampp/htdocs/projet_adam_final/Model/quiz.php';

class QuizC {
    // Récupérer tous les quizzes
    public function getquiz() {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "SELECT * FROM quiz";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getAllquizs() {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "SELECT * FROM quiz";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter un quiz
    public function addquiz($quiz) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "INSERT INTO quiz (sexe, age, poids, niveau_activite, but) 
                VALUES (:sexe, :age, :poids, :niveau_activite, :but)";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':sexe' => $quiz->getSexe(),
                ':age' => $quiz->getAge(),
                ':poids' => $quiz->getPoids(),
                ':niveau_activite' => $quiz->getNiveau(),
                ':but' => $quiz->getBut(),
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Mettre à jour un quiz
    public function updatequiz($id_quiz, $sexe, $age, $poids, $niveau_activite, $but) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "UPDATE quiz SET 
                 sexe = :sexe, 
                 age = :age, 
                 poids = :poids, 
                 niveau_activite = :niveau_activite, 
                 but = :but
                WHERE id_quiz = :id_quiz"; // Suppression de la virgule avant WHERE
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'sexe' => $sexe,
                'age' => $age,
                'poids' => $poids,
                'niveau_activite' => $niveau_activite,
                'but' => $but,
                'id_quiz' => $id_quiz,
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer un quiz
    public function deletequiz($id_quiz) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "DELETE FROM quiz WHERE id_quiz = :id_quiz";
        try {
            $query = $conn->prepare($sql);
            $query->execute([':id_quiz' => $id_quiz]);
    
            // Si aucune ligne n'est affectée, cela signifie que l'ID n'a pas été trouvé
            if ($query->rowCount() > 0) {
                return true; // La suppression a réussi
            } else {
                return false; // Aucun enregistrement trouvé avec cet ID
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Afficher l'erreur en cas de problème
        }
    }
    public function getquizByBut($but) {
        $conn = conn::getConnexion(); // Use the existing database connection
        $sql = "SELECT * FROM quiz WHERE but = :but ORDER BY id DESC LIMIT 1"; // Fetch the quiz with the highest id for the given 'but'
        
        try {
            $query = $conn->prepare($sql);
            $query->execute([':but' => $but]); // Bind the 'but' parameter (Weight Loss or Weight Gain)
            $result = $query->fetch(PDO::FETCH_ASSOC); // Return the quiz with the highest id
            
            // Return the fetched result, which will contain 'but' and other details
            return $result;
            
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Handle any errors
        }
    }
    public function getLatestBut() {
        // Establish database connection
        $conn = conn::getConnexion();
    
        // Query to get the most recent 'but' value based on the latest entry (by id_quiz)
        $sql = "SELECT but FROM quiz ORDER BY id_quiz DESC LIMIT 1"; // Use id_quiz instead of id
    
        try {
            // Prepare and execute the query
            $query = $conn->prepare($sql);
            $query->execute();
    
            // Fetch the result
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            // Check if we got a result and return the 'but' value, default to 'Weight Loss' if no result
            return $result ? $result['but'] : 'Weight Loss'; // Default value in case of no result
        } catch (Exception $e) {
            // Handle any potential errors
            die('Error: ' . $e->getMessage());
        }
    }
    
}
