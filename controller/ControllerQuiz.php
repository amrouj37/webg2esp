<?php
require_once 'C:\xamppp\htdocs\projetsarra\model\Quiz.php';
require_once 'C:\xamppp\htdocs\projetsarra\Config.php';
require_once 'C:\xamppp\htdocs\projetsarra\model\Quiz.php';

class ControllerQuiz {
    private $categorie;
    private $titre;
    private $description;
    private $date_creation;
    
    

    public function __construct() {
        $this->model = new Quiz();
    }

   
    public function getAllQuiz() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM ges_pack";
        try {
            $stmt = $db->query($sql);
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
                ':titre' => htmlspecialchars(strip_tags($titre)),
                ':description' => htmlspecialchars(strip_tags($description)),
                ':date_creation' => htmlspecialchars(strip_tags($date_creation)),
                ':categorie' => htmlspecialchars(strip_tags($categorie)),
            ]);
    
            return true; // Retourne vrai si l'ajout est réussi
        } catch (Exception $e) {
            // Gérer les erreurs
            echo 'Erreur lors de l\'ajout du quiz : ' . $e->getMessage();
            return false;
        }
    }
    
    }

   

   
    function supprimer($idc)
    {
        $sql = "DELETE FROM quiz WHERE id_quiz = :id_quiz";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_quiz', $id_quiz);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
  
    public function getQuizById($id_quiz) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM ges_pack WHERE id_quiz = :id_quiz";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du cours : " . $e->getMessage());
        }
    }


    public function modifier($cours, $idc) 
    {
       
        if (!$quiz) {
            throw new Exception("L'objet quiz est invalide ou manquant.");
        }
    
        try {
            $db = config::getConnexion();
            
    
            // Préparation de la requête SQL
            $query = $db->prepare(
                'UPDATE quizSET 
                    titre = :titre,
                    description = :description,
                    categorie= :categorie
                    date_creation = :date_creation, 
                   
                WHERE id_quiz = :id_quiz',
            );
    
            
            var_dump([
                'titre' => $quiz->gettitre(),
                'description' => $quiz->getdescription(),
                'categorie' => $quiz->getcategorie(),
                'date_creation' => $quiz->getdate_creation(),
                'id_quiz' => $id_quiz
            ]);
            
        
    
            
            $query->execute([
                'id_quiz' => $id_quiz,
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
    


    
?>
