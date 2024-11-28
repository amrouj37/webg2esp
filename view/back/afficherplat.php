<?php
require_once 'C:\xampp\htdocs\QQQQQ\connection.php';
try {
    $pdo = config::getConnexion();
    $stmt = $pdo->query("SELECT * FROM plats");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
