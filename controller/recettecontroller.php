<?php
require_once 'C:\xampp\htdocs\QQQQQ\connection.php';

class RecetteController {
    // Récupérer toutes les recettes
    public function getRecettes() {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM recettes";

        try {
            $query = $conn->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Ajouter une recette
    public function ajouterRecette($recette) {
        $conn = config::getConnexion();

        // Insert query for adding a new recipe
        $sql = "INSERT INTO recettes (nom_recette, nombre_ing, instructions_recette) 
                VALUES (:nom_recette, :nombre_ing, :instructions_recette)";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':nom_recette' => $recette['nom_recette'],
                ':nombre_ing' => $recette['nombre_ing'],
                ':instructions_recette' => $recette['instructions_recette']
            ]);

            echo "Recette ajoutée avec succès!";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Mettre à jour une recette
    public function updateRecette($id, $recette) {
        $conn = config::getConnexion();
        $sql = "UPDATE recettes SET nom_recette = :nom_recette, nombre_ing = :nombre_ing, 
                instructions_recette = :instructions_recette WHERE id_recette = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':nom_recette' => $recette['nom_recette'],
                ':nombre_ing' => $recette['nombre_ing'],
                ':instructions_recette' => $recette['instructions_recette']
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Supprimer une recette
    public function deleteRecette($id) {
        $conn = config::getConnexion();
        $sql = "DELETE FROM recettes WHERE id_recette = :id";

        try {
            $query = $conn->prepare($sql);
            $query->execute([':id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Récupérer une recette par ID
    public function getRecetteById($id) {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM recettes WHERE id_recette = :id";

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
