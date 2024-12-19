<?php
// supprimer.php


require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 


// Vérifiez si un paramètre 'id_quiz' est passé dans l'URL
if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
    try {
        // Préparer la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM packs WHERE id_pack = :id_pack";
        $stmt = conn::getConnexion()->prepare($sql);
        $stmt->bindParam(':id_pack', $_GET['id_pack']);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers la liste après suppression
            header('Location: index.php');
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

