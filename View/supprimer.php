<?php
// supprimer.php


require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 

// Vérifiez si un paramètre 'id_quiz' est passé dans l'URL
if (isset($_GET['id_quiz']) && !empty($_GET['id_quiz'])) {
    try {
        // Préparer la requête pour supprimer l'utilisateur
        $sql = "DELETE FROM Quiz WHERE id_quiz = :id_quiz";
        $stmt = conn::getConnexion()->prepare($sql);
        $stmt->bindParam(':id_quiz', $_GET['id_quiz']);
        
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

