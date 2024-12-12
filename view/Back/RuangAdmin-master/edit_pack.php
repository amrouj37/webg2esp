<?php
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';

$error = "";

// Instantiation of the ControllerPack
$ControllerPack = new ControllerPack();

// Check if ID is passed and valid
if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
    $id_pack = (int)$_GET['id_pack']; // Convert to integer
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit;
}

// Fetch the pack details by ID
$pr = $ControllerPack->getPackById($id_pack); // Fetch the specific pack by ID

if ($pr === null) {
    echo "<div class='alert alert-danger'>Pack introuvable pour cet ID.</div>";
    exit;
}

// Process form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["nom_utilisateur"]) &&
        isset($_POST["contenu"]) &&
        isset($_POST["date_soumission"]) &&
        isset($_POST["categorie"]) &&
        isset($_POST["id_quiz"]) // Ensure id_quiz is passed as well
    ) {
        // Create the Pack object with the form data
        $pack = new Pack(
            null, // The PDO object can be passed here if needed
            $id_pack, // Passing the current ID
            $_POST['nom_utilisateur'],
            $_POST['contenu'],
            $_POST['date_soumission'],
            $_POST['categorie'],
            $_POST['id_quiz'] // Added id_quiz to the Pack object
        );

        // Call the editPack method to update the pack
        $updateStatus = $ControllerPack->editPack($pack, $id_pack);

        if ($updateStatus > 0) {
            header("Location: index.php"); // Redirect after updating
            exit;
        } else {
            $error = "Erreur lors de la mise à jour.";
        }
    } else {
        $error = "Des informations sont manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Pack</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Pack</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nom_utilisateur">Nom Utilisateur</label>
                <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" value="<?= htmlspecialchars($pr['nom_utilisateur']) ?>" placeholder="Entrez le nom utilisateur" required>
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <input type="text" class="form-control" id="contenu" name="contenu" value="<?= htmlspecialchars($pr['contenu']) ?>" placeholder="Entrez le contenu" required>
            </div>

            <div class="form-group">
                <label for="date_soumission">Date de Soumission</label>
                <input type="date" class="form-control" id="date_soumission" name="date_soumission" value="<?= htmlspecialchars($pr['date_soumission']) ?>" required>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?= htmlspecialchars($pr['categorie']) ?>" placeholder="Entrez une catégorie" required>
            </div>

            <div class="form-group">
                <label for="id_quiz">ID Quiz</label>
                <input type="number" class="form-control" id="id_quiz" name="id_quiz" value="<?= htmlspecialchars($pr['id_quiz']) ?>" placeholder="Entrez l'ID du quiz" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Optional: Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
