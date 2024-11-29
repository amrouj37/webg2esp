<?php

class Commande {

    private int $id_commande;
    private string $date_commande;
    private string $adresse_facturation;
    private string $adresse_livraison;

    public function __construct(int $id_commande, string $date_commande, string $adresse_facturation, string $adresse_livraison) {
        $this->id_commande = $id_commande;
        $this->date_commande = $date_commande;
        $this->adresse_facturation = $adresse_facturation;
        $this->adresse_livraison = $adresse_livraison;
    }


    /**
     * Get the value of date_commande
     *
     * @return string
     */
    public function getDateCommande(): string {
        return $this->date_commande;
    }

    /**
     * Set the value of date_commande
     *
     * @param string $date_commande
     *
     * @return self
     */
    public function setDateCommande(string $date_commande): self {
        $this->date_commande = $date_commande;

        return $this;
    }

    /**
     * Get the value of adresse_
     *
     * @return string
     */
    public function getAdresseFacturation(): string {
        return $this->adresse_facturation;
    }

    /**
     * Set the value of adresse_
     *
     * @param string $adresse_
     *
     * @return self
     */
    public function setAdresseFacturation(string $adresse_facturation): self {
        $this->adresse_facturation = $adresse_facturation;

        return $this;
    }

    /**
     * Get the value of adresse_livraison
     *
     * @return string
     */
    public function getAdresseLivraison(): string {
        return $this->adresse_livraison;
    }

    /**
     * Set the value of adresse_livraison
     *
     * @param string $adresse_livraison
     *
     * @return self
     */
    public function setAdresseLivraison(string $adresse_livraison): self {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }
}

?>
