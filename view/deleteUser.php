<?php
require_once '../config.php';

// Vérifiez si un paramètre 'id_user' est passé dans l'URL
if (isset($_GET['id_user']) && !empty($_GET['id_user'])) {
    try {
        // Préparer la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM user WHERE cin_user = :id_user";
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->bindParam(':id_user', $_GET['id_user']);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers la liste après suppression
            header('Location: index2.php');
            exit();
        } else {
            echo "Erreur : Impossible de supprimer l'utilisateur.";
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Erreur : Aucun identifiant utilisateur fourni.";
}
?>
