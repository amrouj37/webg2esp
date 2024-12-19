<?php
class Quiz {
    
    private $id_quiz;
    private $sexe;
    private $age;
    private $poids;
    private $niveau_activite;
    private $but;

    // Constructeur de la classe quiz
    public function __construct($sexe, $age, $poids, $niveau_activite, $but) {
        $this->sexe = $sexe;
        $this->age = $age;
        $this->poids = $poids;
        $this->niveau_activite = $niveau_activite;
        $this->but = $but;
    }

    // Getters et Setters pour chaque propriété
    public function getId() {
        return $this->id_quiz;
    }

    public function setId($id_quiz) {
        $this->id_quiz = $id_quiz;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getPoids() {
        return $this->poids;
    }

    public function setPoids($poids) {
        $this->poids = $poids;
    }

    public function getNiveau() {
        return $this->niveau_activite;
    }

    public function setNiveau($niveau_activite) {
        $this->niveau_activite = $niveau_activite;
    }

    public function getBut() {
        return $this->but;
    }

    public function setBut($but) {
        $this->but = $but;
    }

}
?>
