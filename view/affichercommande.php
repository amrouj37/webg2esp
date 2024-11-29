<?php

require_once 'C:\xampp\htdocs\ABABA\Config.php';

try {

    $pdo = config::getConnexion();
    $stmt = $pdo->query("SELECT * FROM panier");
    $rows = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>