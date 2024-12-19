<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 

class PlatController {
    public function getPlats() {
        $conn = conn::getConnexion();
        // Explicitly selecting 'is_healthy' column
        $sql = "SELECT id_plat, nom_plat, prix_plat, id_recette, url_img, is_healthy FROM plats";  

        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function ajouterplat($plat) {
        $conn = conn::getConnexion();
        $checkRecetteSql = "SELECT COUNT(*) FROM recettes WHERE id_recette = :id_recette";
        try {
            $query = $conn->prepare($checkRecetteSql);
            $query->execute([':id_recette' => $plat['id_recette']]);
            $count = $query->fetchColumn();
            if ($count == 0) {
                echo "Erreur: L'id_recette spécifié n'existe pas dans la table recettes.";
                return;
            }
            $sql = "INSERT INTO plats (nom_plat, prix_plat, id_recette, url_img, is_healthy) 
                    VALUES (:nom_plat, :prix_plat, :id_recette, :url_img, :is_healthy)";
            
            $query = $conn->prepare($sql);
            $query->execute([
                ':nom_plat' => $plat['nom_plat'],
                ':prix_plat' => $plat['prix_plat'],
                ':id_recette' => $plat['id_recette'],
                ':url_img' => $plat['url_img'],
                ':is_healthy' => $plat['is_healthy'] // Include is_healthy field
            ]);

            echo "Plat ajouté avec succès!";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updatePlat($id, $plat) {
        $conn = conn::getConnexion();
        // Update the query to include is_healthy field
        $sql = "UPDATE plats SET nom_plat = :nom_plat, prix_plat = :prix_plat, 
                id_recette = :id_recette, url_img = :url_img, is_healthy = :is_healthy 
                WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':nom_plat' => $plat['nom_plat'],
                ':prix_plat' => $plat['prix_plat'],
                ':id_recette' => $plat['id_recette'],
                ':url_img' => $plat['url_img'],
                ':is_healthy' => $plat['is_healthy'] // Include is_healthy in the update query
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function deletePlat($id) {
        $conn = conn::getConnexion();
        $sql = "DELETE FROM plats WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getPlatById($id) {
        $conn = conn::getConnexion();
        // Include 'is_healthy' in the select statement
        $sql = "SELECT id_plat, nom_plat, prix_plat, id_recette, url_img, is_healthy FROM plats WHERE id_plat = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function getIsHealthy($isHealthy) {
        $conn = conn::getConnexion(); // Get the database connection
    
        // Prepare the SQL query with the dynamic is_healthy value
        $sql = "SELECT * FROM plats WHERE is_healthy = :is_healthy";
        
        try {
            $query = $conn->prepare($sql);
            $query->execute([':is_healthy' => $isHealthy]);
            
          
            
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
           
            return $results; // Return the fetched plats
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    
    
    
}
?>
