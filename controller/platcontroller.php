<?php
require_once 'C:\xampp\htdocs\QQQQQ\connection.php';

class PlatController {
    // Récupérer tous les plats
    public function getPlats() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM plats";

        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter un plat
    public function ajouterplat($plat) {
        $conn = config::getConnexion();
    
        // Step 1: Check if the id_recette exists in the recettes table
        $checkRecetteSql = "SELECT COUNT(*) FROM recettes WHERE id_recette = :id_recette";
        try {
            $query = $conn->prepare($checkRecetteSql);
            $query->execute([':id_recette' => $plat['id_recette']]);
            $count = $query->fetchColumn();
    
            // If the id_recette does not exist, throw an error
            if ($count == 0) {
                echo "Erreur: L'id_recette spécifié n'existe pas dans la table recettes.";
                return;
            }
    
            // Step 2: Proceed with the insertion into the plats table
            $sql = "INSERT INTO plats (nom_plat, prix_plat, id_recette) 
                    VALUES (:nom_plat, :prix_plat, :id_recette)";
            
            $query = $conn->prepare($sql);
            $query->execute([
                ':nom_plat' => $plat['nom_plat'],
                ':prix_plat' => $plat['prix_plat'],
                ':id_recette' => $plat['id_recette']
            ]);
    
            echo "Plat ajouté avec succès!";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    

    // Mettre à jour un plat
    public function updatePlat($id, $plat) {
        $conn = config::getConnexion();
        $sql = "UPDATE plats SET nom_plat = :nom_plat, prix_plat = :prix_plat, 
                id_recette = :id_recette WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':nom_plat' => $plat['nom_plat'],
                ':prix_plat' => $plat['prix_plat'],
                ':id_recette' => $plat['id_recette']
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer un plat
    public function deletePlat($id) {
        $conn = config::getConnexion();
        $sql = "DELETE FROM plats WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Récupérer un plat par ID
    public function getPlatById($id) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM plats WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
