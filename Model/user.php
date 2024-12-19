
<?php
class user {
    
    private $id_user;
    private $cin_user;
    private $nom_user;
    private $prenom_user;
    private $email_user;
    private $adress_user;
    private $num_user;
    private $pwd_user;
    private $role_user;

    // Constructeur de la classe User
    public function __construct($cin_user, $nom_user, $prenom_user, $email_user, $adress_user, $num_user, $pwd_user, $role_user) {
        $this->cin_user = $cin_user;
        $this->nom_user = $nom_user;
        $this->prenom_user = $prenom_user;
        $this->email_user = $email_user;
        $this->adress_user = $adress_user;
        $this->num_user = $num_user;
        $this->pwd_user = $pwd_user;
        $this->role_user = $role_user;
    }

    // Getters et Setters pour chaque propriété
    public function getId() {
        return $this->id_user;
    }

    public function setId($id_user) {
        $this->id_user = $id_user;
    }


    public function getCin() {
        return $this->cin_user;
    }

    public function setCin($cin_user) {
        $this->cin_user = $cin_user;
    }


    public function getNom() {
        return $this->nom_user;
    }

    public function setNom($nom_user) {
        $this->nom_user = $nom_user;
    }


    public function getPrenom() {
        return $this->prenom_user;
    }

    public function setPrenom($prenom_user) {
        $this->prenom_user = $prenom_user;
    }


    public function getEmail() {
        return $this->email_user;
    }

    public function setEmail($email_user) {
        $this->email_user = $email_user;
    }

    public function getAdress() {
        return $this->adress_user;
    }

    public function setAdress($adress_user) {
        $this->adress_user = $adress_user;
    }


    public function getNum() {
        return $this->num_user;
    }

    public function setNum($num_user) {
        $this->num_user = $num_user;
    }


    public function getPwd() {
        return $this->pwd_user;
    }

    public function setPwd($pwd_user) {
        $this->pwd_user = $pwd_user;
    }

    public function getRole() {
        return $this->role_user;
    }

    public function setRole($role_user) {
        $this->role_user = $role_user;
    }
}
?>
