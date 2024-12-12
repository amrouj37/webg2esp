<?php
// Inclure le contrôleur ControllerPack
include "C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php";

// Créer une instance du contrôleur
$controllerPack = new ControllerPack(); // Use ControllerPack, not Pack

// Initialiser un tableau pour afficher les résultats
$afficher = [];

// Vérifier si le formulaire de recherche a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSearch'])) {
    // Récupérer la valeur du bouton de recherche
    $btnSearch = "%" . $_POST['btnSearch'] . "%"; // Use LIKE with wildcards
    
    // Fetch search results based on the title
    $afficher = $controllerPack->searchPackByTitle($btnSearch); // Call searchPackByTitle
} else {
    // Si aucune recherche n'est effectuée, afficher tous les packs
    $afficher = $controllerPack->getAllPack(); // Fetch all packs using ControllerPack
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Packs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for better table appearance */
        .table th, .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-edit, .btn-delete {
            font-size: 14px;
            padding: 6px 12px;
            margin: 5px;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .search-form {
            margin: 20px 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
    </style>
</head>
<body>

<!-- Search Form -->
<div class="container">
    <form method="POST" action="list_pack.php" class="search-form">
        <div class="input-group">
            <input type="text" name="btnSearch" class="form-control" placeholder="Rechercher par titre" required>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    <!-- Table of Quizzes -->
    <h2 class="header">Liste des Packs</h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nom utilisateur</th>
                <th>Contenu</th>
                <th>Date soumission</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Vérifier s'il y a des quizzes à afficher
            if (!empty($afficher)) {
                foreach ($afficher as $pack) {
                    echo "<tr>
                        <td>" . htmlspecialchars($pack['id_pack']) . "</td>
                        <td>" . htmlspecialchars($pack['nom_utilisateur']) . "</td>
                        <td>" . htmlspecialchars($pack['contenu']) . "</td>
                        <td>" . htmlspecialchars($pack['date_soumission']) . "</td>
                        <td>" . htmlspecialchars($pack['categorie']) . "</td>
                        <td>
                            <a href='edit_pack.php?id_pack=" . urlencode($pack['id_pack']) . "' class='btn btn-sm btn-edit'>Mettre à jour</a>
                            <a href='delete_pack.php?id_pack=" . urlencode($pack['id_pack']) . "' class='btn btn-sm btn-delete' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce pack ?\");'>Supprimer</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Aucun quiz trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
