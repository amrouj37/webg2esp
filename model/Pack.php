<?php

class Pack {
    private $id_pack;
    private $nom_utilisateur;
    private $contenu;
    private $date_soumission;
    private $categorie;
    private $id_quiz; // Foreign key

    public function __construct($id_pack = null, $nom_utilisateur = null, $contenu = null, $date_soumission = null, $categorie = null, $id_quiz = null) {
        $this->id_pack = $id_pack;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->contenu = $contenu;
        $this->date_soumission = $date_soumission;
        $this->categorie = $categorie;
        $this->id_quiz = $id_quiz;
    }

    public function getIdPack() {
        return $this->id_pack;
    }

    public function setIdPack($id_pack) {
        $this->id_pack = $id_pack;
    }

    public function getNomUtilisateur() {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur($nom_utilisateur) {
        $this->nom_utilisateur = $nom_utilisateur;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getDateSoumission() {
        return $this->date_soumission;
    }

    public function setDateSoumission($date_soumission) {
        $this->date_soumission = $date_soumission;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    public function getIdQuiz() {
        return $this->id_quiz;
    }

    public function setIdQuiz($id_quiz) {
        $this->id_quiz = $id_quiz;
    }
}
?>
