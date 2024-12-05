<?php

class pack {
    private $pdo;
    private $id_pack;
    private $nom_utilisateur;
    private $contenu;
    private $date_soumission;
    private $categorie;
    
   
   

    public function __construct($pdo = null, $id_pack= null, $nom_utilisateur = null, $contenu = null, $date_soumission=  null, $categorie= null)  {
        $this->pdo = $pdo ?? config::getConnexion();
        $this->id_pack = $id_pack;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->contenu = $contenu;
        $this->date_soumission = $date_soumission;
        $this->categorie = $categorie;
      
    }



    public function getid_pack(){
        return $this->id_pack;
    }
    public function setid_pack($id_pack){
        $this->id_pack=$id_pack;
    }
    public function getnom_utilisateur(){
        return $this->nom_utilisateur;
    }
    public function setnom_utilisateur($nom_utilisateur){
        $this->nom_utilisateur=$nom_utilisateur;
    }
    public function getcontenu(){
        return $this->contenu;
    }
    public function setcontenu($contenu){
        $this->contenu=$contenu;
    }
    public function getdate_soumission(){
        return $this->date_soumission;
    }
    public function setdate_soumission($date_soumission){
        $this->date_soumission=$date_soumission;
    }
    public function getcategorie(){
        return $this->date_ceation;
    }
    public function setcategorie($categorie){
        $this->categorie=$categorie;
    }
    

    public function delete_pack($id_pack) {
        $sql = "DELETE FROM pack WHERE id_pack = :id_pack";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pack' => $id_pack]);
            return true;  // Return true if deletion was successful
        } catch (PDOException $e) {
            // Catch PDO exceptions and throw a custom exception
            throw new Exception("Erreur lors de la suppression du pack : " . $e->getMessage());
        }
    }

    public function getById($idp) {
        $sql = "SELECT * FROM pack WHERE id_pack = :id_pack";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pack' => $id_pack]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du pack : " . $e->getMessage());
        }
    }

    public function getAllpack() {
        $sql = "SELECT * FROM pack";
        try {
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des packs : " . $e->getMessage());
        }
    }
}
?>
