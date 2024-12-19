<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 

try {
    $pdo = conn::getConnexion();
    $stmt = $pdo->query("SELECT id_plat, nom_plat, prix_plat, id_recette, url_img, is_healthy FROM plats");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
