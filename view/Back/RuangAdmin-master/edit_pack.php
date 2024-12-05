<?php
require_once 'C:\xamppp\htdocs\projetsarra\Config.php';
require_once 'C:/xamppp/htdocs/projetsarra/controller/ControllerPack.php';
require_once 'C:/xamppp/htdocs/projetsarra/model/Pack.php';

$error = "";

// Instanciation du contrôleur
$ControllerPack = new ControllerPack();

// Vérifiez que l'ID est défini dans $_GET
if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
    $id_pack = (int)$_GET['id_pack']; // Convertir l'ID en entier
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit; // Arrêtez l'exécution si l'ID est manquant ou invalide
}

// Récupérez les détails du quiz par ID
$list = $ControllerPack->getAllPack(); // Fixed the function name to getAllQuiz
$pr = null;

foreach ($list as $row) {
    if ($row['id_pack'] == $id_pack) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Pack introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["nom_utilisateur"]) && isset($_POST["contenu"]) &&
        isset($_POST["date_soumission"]) && isset($_POST["categorie"])
    ) {



        if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
            $id_pack = intval($_GET['id_pack']);
            echo "ID reçu : " . htmlspecialchars($id_pack);
        } else {
            echo "ID non reçu ou vide.";
            exit;
        }
        
        // Instanciez l'objet quiz avec les données soumises
        $pack = new Pack(
            null, // The PDO object can be passed here if necessary
            $id_pack, // Passing the current ID
            $_POST['nom_utilisateur'],
            $_POST['contenu'],
            $_POST['date_soumission'],
            $_POST['categorie']
        );

        // Appelez la méthode de mise à jour
        $ControllerPack->modifier($pack, $id_pack);
        header("Location: liste_pack.php"); // Redirect after updating
        exit;
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
                <label for="nom_utilisateur">nom_utilisateur</label>
                <input type="text" class="form-control" id="nom_utilisateur" name="nom_utilisateur" value="<?= htmlspecialchars($pr['nom_utilisateur']) ?>" placeholder="Entrez le nom_utilisateur" required>
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <input type="text" class="form-control" id="contenu" name="contenu" value="<?= htmlspecialchars($pr['contenu']) ?>" placeholder="Entrez la catégorie" required>
            </div>

            <div class="form-group">
                <label for="date_soumission">Date de soumission</label>
                <input type="date" class="form-control" id="date_soumission" name="date_soumission" value="<?= htmlspecialchars($pr['date_soumission']) ?>" required>
            </div>

            <div class="form-group">
                <label for="categorie">categorie</label>
                <textarea class="form-control" id="categorie" name="categorie" placeholder="Entrez une categorie" rows="3" required><?= htmlspecialchars($pr['categorie']) ?></textarea>
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
