<?php
require_once '../Config.php';

class CommandeController {
    // Récupérer tous les commandes
    public function getCommandes() {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "SELECT * FROM commande"; // You may adjust this SQL based on the actual table structure

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute(); // Exécution de la requête
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les résultats sous forme de tableau associatif
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Ajouter un commande
    public function addCommande($commande) {
        $conn = config::getConnexion(); // Connexion à la base de données
        
        // Updated SQL query for the commande table (we use 'id_commande' here)
        $sql = "INSERT INTO commande(id_commande, date_commande, adresse_livraison, adresse_facturation) 
                VALUES (:id_commande, :date_commande, :adresse_livraison, :adresse_facturation)";
    
        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([
                ':id_commande' => $commande['id_commande'],         // Insert the 'id_commande'
                ':date_commande' => $commande['date_commande'],     // Insert the 'date_commande'
                ':adresse_livraison' => $commande['adresse_livraison'],  // Insert the 'adresse_livraison'
                ':adresse_facturation' => $commande['adresse_facturation'] // Insert the 'adresse_facturation'
            ]); // Exécution avec les valeurs du commande
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
    

    // Mettre à jour un commande
    public function updateCommande($id, $commande) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "UPDATE commande SET
                    date_commande = :date_commande, 
                    adresse_livraison = :adresse_livraison, 
                    adresse_facturation = :adresse_facturation, 
                WHERE id_commande = :id_commande";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([
                ':date_commande' => $commande['date_commande'],
                ':adresse_livraison' => $commande['adresse_livraison'],
                ':adresse_facturation' => $commande['adresse_facturation'],
            ]); // Exécution de la mise à jour
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Supprimer un commande
    public function deleteCommande($id) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "DELETE FROM commande WHERE id_commande = :id_commande";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([':id_commande' => $id]); // Exécution de la suppression
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Récupérer un commande par ID
    public function getCommandeById($id) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "SELECT * FROM commande WHERE id_commande = :id_commande";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([':id_commande' => $id]); // Exécution de la requête
            return $query->fetch(PDO::FETCH_ASSOC); // Retourne le résultat unique sous forme de tableau associatif
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
}
?>
