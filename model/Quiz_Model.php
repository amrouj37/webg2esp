<?php
class Quiz {
    public $titre;
    public $description;
    public $date_creation;
    public $categorie;

    // Constructeur qui initialise les propriétés de l'objet
    public function __construct($titre, $description, $date_creation, $categorie) {
        $this->titre = $titre;
        $this->description = $description;
        $this->date_creation = $date_creation;
        $this->categorie = $categorie;
    }

    // Méthode pour afficher les informations du quiz
    public function show() {
        echo "<table border='1'>"; // Table avec bordure pour afficher les données
        echo "<tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de Création</th>
                <th>Catégorie</th>
              </tr>";
        echo "<tr>
                <td>{$this->titre}</td> <!-- Affiche le titre -->
                <td>{$this->description}</td> <!-- Affiche la description -->
                <td>{$this->date_creation}</td> <!-- Affiche la date de création -->
                <td>{$this->categorie}</td> <!-- Affiche la catégorie -->
              </tr>";
        echo "</table>";
    }
}
?>
