<?php
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';
require_once 'C:/xamppp/htdocs/projetsarra/config.php';

class ControllerPack {
    private $nom_utilisateur;
    private $contenu;
    private $date_soumission;
    private $categorie;

    public function __construct() {
        $this->model = new Pack();
    }

    // Fetch pack by id
    public function getPackById($id_pack) {
        $conn = config::getConnexion();
        $sql = "SELECT p.*, q.titre AS quiz_titre 
                FROM pack p
                LEFT JOIN quiz q ON p.id_quiz = q.id_quiz
                WHERE p.id_pack = :id_pack";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_pack', $id_pack, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du pack : " . $e->getMessage());
        }
    }

    // Add a new pack
    public function addPack($nom_utilisateur, $contenu, $date_soumission, $categorie, $id_quiz) {
        // Vérifier si le quiz existe avant de l'ajouter au pack
        $conn = config::getConnexion();
        
        // Vérifiez si le quiz avec cet id existe
        $sql_check_quiz = "SELECT COUNT(*) FROM quiz WHERE id_quiz = :id_quiz";
        $stmt_check = $conn->prepare($sql_check_quiz);
        $stmt_check->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
        $stmt_check->execute();
        $quiz_exists = $stmt_check->fetchColumn();
        
        // Si le quiz n'existe pas, lever une exception
        if ($quiz_exists == 0) {
            throw new Exception("Le quiz associé avec l'ID fourni n'existe pas.");
        }
    
        // Si le quiz existe, procéder à l'ajout du pack
        $sql = "INSERT INTO pack (nom_utilisateur, contenu, date_soumission, categorie, id_quiz)
                VALUES (:nom_utilisateur, :contenu, :date_soumission, :categorie, :id_quiz)";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':nom_utilisateur' => $nom_utilisateur,
                ':contenu' => $contenu,
                ':date_soumission' => $date_soumission,
                ':categorie' => $categorie,
                ':id_quiz' => $id_quiz
            ]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du pack : " . $e->getMessage());
        }
    }
    
    
    

    // Edit an existing pack
    public function editPack($pack, $id_pack) {
        if (!$pack) {
            throw new Exception("L'objet pack est invalide ou manquant.");
        }
    
        try {
            $conn = config::getConnexion();
    
            // Get the id_quiz value from the Pack object
            $id_quiz = $pack->getIdQuiz();
    
            // Check if the id_quiz exists in the quiz table
            $sql_check_quiz = "SELECT COUNT(*) FROM quiz WHERE id_quiz = :id_quiz";
            $stmt_check = $conn->prepare($sql_check_quiz);
            $stmt_check->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
            $stmt_check->execute();
            $quiz_exists = $stmt_check->fetchColumn();
    
            if ($quiz_exists == 0) {
                // If the quiz ID doesn't exist, throw an error
                throw new Exception("Le quiz associé n'existe pas.");
            }
    
            // Proceed with the update if the quiz ID exists
            $sql = "UPDATE pack SET 
                        nom_utilisateur = :nom_utilisateur,
                        contenu = :contenu,
                        date_soumission = :date_soumission,
                        categorie = :categorie,
                        id_quiz = :id_quiz
                    WHERE id_pack = :id_pack";
    
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':id_pack' => $id_pack,
                ':nom_utilisateur' => $pack->getNomUtilisateur(),
                ':contenu' => $pack->getContenu(),
                ':date_soumission' => $pack->getDateSoumission(),
                ':categorie' => $pack->getCategorie(),
                ':id_quiz' => $id_quiz
            ]);
    
            // Return the number of affected rows
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
    
        } catch (PDOException $e) {
            // Handle PDO exceptions
            echo "Erreur PDO : " . $e->getMessage();
        } catch (Exception $e) {
            // Handle general exceptions
            echo "Erreur : " . $e->getMessage();
        }
    }
    
    
    
    public function deletePack($id_pack) {
        $conn = config::getConnexion();
        $sql = "DELETE FROM pack WHERE id_pack = :id_pack";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_pack', $id_pack, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du pack : " . $e->getMessage());
        }
    }

    // Search packs by title or content
    public function searchPackByTitle($title) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM pack WHERE nom_utilisateur LIKE :title OR contenu LIKE :title";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Get all packs
    public function getAllPack() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM pack";
        try {
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des packs : " . $e->getMessage());
        }
    }
}
?>
