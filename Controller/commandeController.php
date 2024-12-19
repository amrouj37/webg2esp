<?php
require_once '../Model/commande.php';

class CommandeController {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=salah2', 'root', '');
    }

    public function createCommande($adresseLivraison, $adresseFacturation) {
        $dateCommande = date('Y-m-d');

        $stmt = $this->pdo->prepare("INSERT INTO commande (date_commande, adresse_livraison, adresse_facturation) VALUES (?, ?, ?)");
        $stmt->execute([$dateCommande, $adresseLivraison, $adresseFacturation]);

        return $this->pdo->lastInsertId(); // Return the newly created commande ID
    }
}
?>