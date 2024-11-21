<?php

require_once 'C:\xampp\htdocs\QQQQQ\connection.php';

try {
    $pdo =config::getConnexion();
    $stmt = $pdo->query("SELECT * FROM recettes");
    $rows = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>