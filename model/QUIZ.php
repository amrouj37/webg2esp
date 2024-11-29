<?php
require_once _DIR_ . '/../config.php';

class quiz {
    private $pdo;
    private $id_quiz;
    private $titre;
    private $description;
    private $categorie;
    private $date_creation;
   

    public function __construct($pdo = null, $id_quiz = null, $titre = null, $description = null, $categorie=  null, $date_creation = null)  {
        $this->pdo = $pdo ?? config::getConnexion();
        $this->id_quiz = $id_quiz;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie = $categorie;
        $this->date_creation = $date_creation;
      
    }


    public function ajout() {
        $sql = "INSERT INTO cours (titre, description, categorie, date_creation) 
                VALUES (:titre, :description, :categorie, :date_creation)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'titre' => $this->titre,
                'description' => $this->description,
                'categorie' => $this->categorie,
                'date_creation' => $this->date_creation,
                
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du quiz : " . $e->getMessage());
        }
    }

    public function getid_quiz(){
        return $this->id_quiz;
    }
    public function setid_quiz($id_quiz){
        $this->id_quiz=$id_quiz;
    }
    public function gettitre(){
        return $this->titre;
    }
    public function settitre($titre){
        $this->titre=$titre;
    }
    public function getdescription(){
        return $this->description;
    }
    public function setdescription($description){
        $this->description=$description;
    }
    public function getcategorie(){
        return $this->categorie;
    }
    public function setcategorie($categorie){
        $this->categorie=$categorie;
    }
    public function getdate_creation(){
        return $this->date_ceation;
    }
    public function setdate_creation($date_creation){
        $this->date_creation=$date_creation;
    }
    

    public function supprimer($id_quiz) {
        $sql = "DELETE FROM ges_pack WHERE id_quiz = :id_quiz";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_quiz' => $id_quiz]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du quiz : " . $e->getMessage());
        }
    }

    public function getById($idc) {
        $sql = "SELECT * FROM ges_pack WHERE id_quiz = :id_quiz";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_quiz' => $id_quiz]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du quiz : " . $e->getMessage());
        }
    }

    public function getAllQuiz() {
        $sql = "SELECT * FROM ges_pack";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des quizs : " . $e->getMessage());
        }
    }
}
?>
