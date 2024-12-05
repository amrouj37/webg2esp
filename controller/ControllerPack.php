<?php
require_once 'C:\xamppp\htdocs\projetsarra\model\Pack.php';
require_once 'C:\xamppp\htdocs\projetsarra\Config.php';

class ControllerPack {
    private $nom_utilisateur;
    private $contenu;
    private $date_soumission;
    private $categorie;

    public function __construct() {
        $this->model = new Pack();
    }

    public function getAllPack() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM pack";
        try {
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des quizs : " . $e->getMessage());
        }
    }

    public function add_pack($nom_utilisateur, $contenu, $date_soumission, $categorie) {
        try {
            // Connexion à la base de données
            $conn = Config::getConnexion();
    
            // Préparation de la requête SQL
            $sql = "INSERT INTO pack (nom_utilisateur, contenu, date_soumission, categorie) 
                    VALUES (:nom_utilisateur, :contenu, :date_soumission, :categorie)";
            
            $stmt = $conn->prepare($sql);
    
            // Exécution de la requête avec les valeurs sécurisées
            $stmt->execute([
                ':nom_utilisateur' => $nom_utilisateur,
                ':contenu' => $contenu,
                ':date_soumission' => $date_soumission,
                ':categorie' => $categorie,
            ]);
    
            return true; // Retourne vrai si l'ajout est réussi
        } catch (Exception $e) {
            // Gérer les erreurs
            echo 'Erreur lors de l\'ajout du quiz : ' . $e->getMessage();
            return false;
        }
    }

    public function deletePack($id_pack) {
        try {
            return $this->model->delete_pack($id_pack);  // Call the delete method from the Quiz model
        } catch (Exception $e) {
            // Handle any errors that occur in the model
            echo 'Erreur lors de la suppression du pack : ' . $e->getMessage();
            return false;
        }
    }
    

    function getPackById($id_pack) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM pack WHERE id_pack = :id_pack";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_pack', $id_pack, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du pack : " . $e->getMessage());
        }
    }

    function edit_pack($pack, $idp) {
        if (!$pack) {
            throw new Exception("L'objet pack est invalide ou manquant.");
        }

        try {
            $conn = config::getConnexion();
    
            // Préparation de la requête SQL
            $query = $conn->prepare(
                'UPDATE pack SET 
                    nom_utilisateur = :nom_utilisateur,
                    contenu = :contenu,
                    date_soumission = :date_soumission,
                    categorie = :categorie,
                WHERE id_pack = :id_pack'
            );
    
            $query->execute([
                'id_pack' => $idp,
                'nom_utilisateur' => $pack->getnom_utilisateur(),
                'contenu' => $pack->getpack(),
                'date_soumission' => $pack->getdate_soumission(),
                'categorie' => $pack->getcategorie(),
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
}
?>
