<?php
class PanierController {
    private $panier = [];
    
    public function __construct() {
        // Start the session if it hasn't been started yet
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Initialize the cart in the session if it doesn't already exist
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Load the cart from the session
        $this->panier = $_SESSION['panier'];
    }

    public function addToPanier($produitName) {
        // Check if the product already exists in the cart
        foreach ($this->panier as &$item) {
            if ($item['produit'] === $produitName) {
                $item['quantite']++;
                $_SESSION['panier'] = $this->panier; // Update the session
                return;
            }
        }

        // Add a new product to the cart
        $newItem = [
            'id' => count($this->panier) + 1, // Generate an ID
            'produit' => $produitName,
            'quantite' => 1
        ];
        $this->panier[] = $newItem; // Add to the internal cart array
        $_SESSION['panier'] = $this->panier; // Update the session
    }

    public function getPanier() {
        return $this->panier;
    }

    public function updateQuantity($id, $newQuantity) {
        foreach ($this->panier as &$item) {
            if ($item['id'] == $id) {
                $item['quantite'] = $newQuantity; // Update the quantity
                $_SESSION['panier'] = $this->panier; // Update the session
                return;
            }
        }
    }

    public function removeFromPanier($id) {
        // Filter out the item to be removed
        $this->panier = array_filter($this->panier, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        // Reindex the array and update the session
        $this->panier = array_values($this->panier);
        $_SESSION['panier'] = $this->panier;
    }
}
?>
