<?php
require_once 'C:/xampp/htdocs/projet_adam_final/config.php'; 
require_once 'C:/xampp/htdocs/projet_adam_final/Model/pack.php';

class PackC {
    // Récupérer tous les packszes
    public function getpacks() {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "SELECT * FROM packs";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getAllpacks() {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "SELECT * FROM packs";
        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter un packs
    public function addpacks($packs) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "INSERT INTO packs (type) 
                VALUES (:type)";
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':type' => $packs->gettype (),
              
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Mettre à jour un packs
    public function updatepacks($id_pack, $type) {
        $conn = conn::getConnexion();
    
        $sql = "UPDATE packs SET 
                    type = :type
                WHERE id_pack = :id_pack"; 
    
        try {
            // Préparation de la requête SQL
            $query = $conn->prepare($sql);
            
            // Affichage des paramètres avant exécution pour débogage
            var_dump([
                ':type' => $type,
                ':id_pack' => $id_pack
            ]);
    
            // Exécution de la requête avec les bons paramètres
            $query->execute([
                ':type' => $type,
                ':id_pack' => $id_pack
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    

    // Supprimer un packs
    public function deletepacks($id_pack) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "DELETE FROM packs WHERE id_pack = :id_pack";
        try {
            $query = $conn->prepare($sql);
            $query->execute([':id_pack' => $id_pack]);
    
            // Si aucune ligne n'est affectée, cela signifie que l'ID n'a pas été trouvé
            if ($query->rowCount() > 0) {
                return true; // La suppression a réussi
            } else {
                return false; // Aucun enregistrement trouvé avec cet ID
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Afficher l'erreur en cas de problème
        }
    }
    

    // Récupérer un packs par ID
    public function getpacksById($id_pack) {
        $conn = conn::getConnexion(); // Correction de conn -> conn
        $sql = "SELECT * FROM packs WHERE id_pack = :id_pack";
        try {
            $query = $conn->prepare($sql);
            $query->execute(['id_pack' => $id_pack]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result === false) {
                echo "Aucun packs trouvé avec l'ID : " . $id_pack;
            }
            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
