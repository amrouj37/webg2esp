<?php

class Quiz {
    private $pdo;
    private $id_quiz;
    private $titre;
    private $description;
    private $categorie;
    private $date_creation;

    // Constructor to initialize the properties
    public function __construct($pdo = null, $id_quiz = null, $titre = null, $description = null, $categorie = null, $date_creation = null) {
        $this->pdo = $pdo ?? config::getConnexion();
        $this->id_quiz = $id_quiz;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie = $categorie;
        $this->date_creation = $date_creation;
    }

    // Getters and setters
    public function getIdQuiz() {
        return $this->id_quiz;
    }

    public function setIdQuiz($id_quiz) {
        $this->id_quiz = $id_quiz;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }
}
?>
