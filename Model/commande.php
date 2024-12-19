<?php
class Commande {
    public $id_commande;
    public $date_commande;
    public $adresse_livraison;
    public $adresse_facturation;

    public function __construct($date_commande, $adresse_livraison, $adresse_facturation) {
        $this->date_commande = $date_commande;
        $this->adresse_livraison = $adresse_livraison;
        $this->adresse_facturation = $adresse_facturation;
    }
}
?>