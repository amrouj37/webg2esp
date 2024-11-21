<?php
require_once '../Config.php';

class PanierController {
    // Récupérer tous les paniers
    public function getPaniers() {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "SELECT * FROM panier";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute(); // Exécution de la requête
            return $query->fetchAll(); // Retourne tous les résultats
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Ajouter un panier
    public function addPanier($panier) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "INSERT INTO panier(quantite, prix_unitaire, date_ajout) 
                VALUES (:quantite, :prix_unitaire, :date_ajout)";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([
                ':quantite' => $panier['quantite'],
                ':prix_unitaire' => $panier['prix_unitaire'],
                ':date_ajout' => $panier['date_ajout']
            ]); // Exécution avec les valeurs du panier
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Mettre à jour un panier
    public function updatePanier($id, $panier) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "UPDATE panier SET quantite = :quantite, prix_unitaire = :prix_unitaire, date_ajout = :date_ajout 
                WHERE id_panier = :id_panier";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([
                ':id_panier' => $id,
                ':quantite' => $panier['quantite'],
                ':prix_unitaire' => $panier['prix_unitaire'],
                ':date_ajout' => $panier['date_ajout']
            ]); // Exécution de la mise à jour
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Supprimer un panier
    public function deletePanier($id) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "DELETE FROM panier WHERE id_panier = :id_panier";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([':id_panier' => $id]); // Exécution de la suppression
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }

    // Récupérer un panier par ID
    public function getPanierById($id) {
        $conn = config::getConnexion(); // Connexion à la base de données
        $sql = "SELECT * FROM panier WHERE id_panier = :id_panier";

        try {
            $query = $conn->prepare($sql); // Préparation de la requête
            $query->execute([':id_panier' => $id]); // Exécution de la requête
            return $query->fetch(); // Retourne le résultat unique
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
}
