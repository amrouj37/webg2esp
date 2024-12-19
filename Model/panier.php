<?php
// Model: panier.php
class Panier {
    public $id;
    public $produit;
    public $quantite;

    public function __construct($id, $produit, $quantite) {
        $this->id = $id;
        $this->produit = $produit;
        $this->quantite = $quantite;
    }
}
?>
