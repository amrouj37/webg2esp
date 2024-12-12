<?php
// Include the ControllerQuiz
include "C:/xamppp/htdocs/projetsarra/controller/ControllerQuiz.php";

// Create an instance of the controller
$controllerQuiz = new ControllerQuiz();

// Initialize the array for displaying results
$afficher = [];

// Check if the search form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSearch'])) {
    // Get the search value
    $btnSearch = "%" . $_POST['btnSearch'] . "%"; // Use LIKE with wildcards
    
    // Fetch search results based on the title
    $afficher = $controllerQuiz->searchQuizByTitle($btnSearch);
} else {
    // If no search is performed, display all quizzes
    $afficher = $controllerQuiz->getAllQuiz();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Quizzes</title>
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
    <form method="POST" action="liste.php" class="search-form">
        <div class="input-group">
            <input type="text" name="btnSearch" class="form-control" placeholder="Rechercher par titre" required>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
        <a href="exporterExel.php" class="btn btn-custom shadow-sm px-4 py-2">
            <i class="fas fa-file-excel"></i> Exporter en Excel
        </a>
    </form>

    <!-- Table of Quizzes -->
    <h2 class="header">Liste des Quizzes</h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de Création</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any quizzes to display
            if (!empty($afficher)) {
                foreach ($afficher as $quiz) {
                    echo "<tr>
                        <td>" . htmlspecialchars($quiz['id_quiz']) . "</td>
                        <td>" . htmlspecialchars($quiz['titre']) . "</td>
                        <td>" . htmlspecialchars($quiz['description']) . "</td>
                        <td>" . htmlspecialchars($quiz['date_creation']) . "</td>
                        <td>" . htmlspecialchars($quiz['categorie']) . "</td>
                        <td>
                            <a href='modifier.php?id_quiz=" . urlencode($quiz['id_quiz']) . "' class='btn btn-sm btn-edit'>Mettre à jour</a>
                            <a href='supprimer.php?id_quiz=" . urlencode($quiz['id_quiz']) . "' class='btn btn-sm btn-delete' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce quiz ?\");'>Supprimer</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Aucun quiz trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </script>

   </script>   
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  

</body>
</html>
