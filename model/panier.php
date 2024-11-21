<?php

class Panier {

    private int $id_panier;
    private int $quantite;
    private string $prix_unitaire;
    private string $date_ajout;

    public function __construct(int $id_panier, int $quantite, string $prix_unitaire, string $date_ajout) {
        $this->id_panier = $id_panier;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->date_ajout = $date_ajout;
    }

    /**
     * Get the value of id_panier
     *
     * @return int
     */
    public function getIdPanier(): int {
        return $this->id_panier;
    }

    /**
     * Set the value of id_panier
     *
     * @param int $id_panier
     *
     * @return self
     */
    public function setIdPanier(int $id_panier): self {
        $this->id_panier = $id_panier;

        return $this;
    }

    /**
     * Get the value of quantite
     *
     * @return int
     */
    public function getQuantite(): int {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @param int $quantite
     *
     * @return self
     */
    public function setQuantite(int $quantite): self {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix_unitaire
     *
     * @return string
     */
    public function getPrixUnitaire(): string {
        return $this->prix_unitaire;
    }

    /**
     * Set the value of prix_unitaire
     *
     * @param string $prix_unitaire
     *
     * @return self
     */
    public function setPrixUnitaire(string $prix_unitaire): self {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    /**
     * Get the value of date_ajout
     *
     * @return string
     */
    public function getDateAjout(): string {
        return $this->date_ajout;
    }

    /**
     * Set the value of date_ajout
     *
     * @param string $date_ajout
     *
     * @return self
     */
    public function setDateAjout(string $date_ajout): self {
        $this->date_ajout = $date_ajout;

        return $this;
    }
}

?>
