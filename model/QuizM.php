<?php

class Quiz {
    private string $titre;
    private string $description;
    private string $dateCreation;
    private string $categorie;

    // Constructeur pour initialiser les propriétés
    public function __construct(string $titre, string $description, string $dateCreation, string $categorie) {
        $this->titre = $titre;
        $this->description = $description;
        $this->dateCreation = $dateCreation;
        $this->categorie = $categorie;
    }

    /**
     * Get the value of titre
     *
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @param string $titre
     * @return self
     */
    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of dateCreation
     *
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @param string $dateCreation
     * @return self
     */
    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get the value of categorie
     *
     * @return string
     */
    public function getCategorie(): string
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @param string $categorie
     * @return self
     */
    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
?>
