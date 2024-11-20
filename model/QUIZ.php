<?php
class Quiz {
    // Propriétés de l'entité Quiz
    private $id_quiz;
    private $titre;
    private $description;
    private $dateCreation;
    private $categorie;

    // Constructeur de la classe Quiz
    public function __construct($titre, $description, $dateCreation, $categorie) {
        $this->titre = $titre;
        $this->description = $description;
        $this->dateCreation = $date_Creation;
        $this->categorie = $categorie;
    }

    // Getters et Setters pour chaque propriété
    public function getId() {
        return $this->id_quiz;
    }

    public function setId($id) {
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

    public function getDate_Creation() {
        return $this->date_Creation;
    }

    public function setDateCreation($date_Creation) {
        $this->date_Creation = $date_Creation;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
}
?>
