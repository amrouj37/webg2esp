<?php

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
        $sql = "DELETE FROM quiz WHERE id_quiz = :id_quiz";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_quiz' => $id_quiz]);
            return true;  // Return true if deletion was successful
        } catch (PDOException $e) {
            // Catch PDO exceptions and throw a custom exception
            throw new Exception("Erreur lors de la suppression du quiz : " . $e->getMessage());
        }
    }

    public function getById($idc) {
        $sql = "SELECT * FROM quiz WHERE id_quiz = :id_quiz";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_quiz' => $id_quiz]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du quiz : " . $e->getMessage());
        }
    }

    public function getAllQuiz() {
        $sql = "SELECT * FROM quiz";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des quizs : " . $e->getMessage());
        }
    }
}
?>
