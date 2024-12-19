<?php
require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\packC.php';
require_once 'C:\xampp\htdocs\projet_adam_final\Model\pack.php';

$error = "";

// Instanciation du contrôleur
$packC = new packC();

// Vérifiez que l'ID est défini dans $_GET
if (isset($_GET['id_pack']) && !empty($_GET['id_pack'])) {
    $id_pack = (int)$_GET['id_pack']; // Convertir l'ID en entier
} else {
    echo "<div class='alert alert-danger'>ID manquant ou invalide.</div>";
    exit; // Arrêtez l'exécution si l'ID est manquant ou invalide
}

// Récupérez les détails du quiz par ID
$list = $packC->getAllpacks(); // Fixed the function name to getAllQuiz
$pr = null;

foreach ($list as $row) {
    if ($row['id_pack'] == $id_pack) {
        $pr = $row;
        break;
    }
}

if ($pr === null) {
    echo "<div class='alert alert-danger'>Quiz introuvable pour cet ID.</div>";
    exit;
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["type"])
       
    ) {
        // Appelez la méthode de mise à jour en passant les 6 arguments séparés
        $packC->updatepacks(
            $id_pack,  // L'ID du quiz
            $_POST['type']
           
        );
        header("Location: index.php"); // Redirect after updating
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
    <title>updatepack un pack</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">updatepack un pack</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="type">type</label>
                <input type="text" class="form-control" id="type" name="type" value="<?= htmlspecialchars($pr['type']) ?>" placeholder="Entrez le type du pack" required>
            </div>


            <button type="submit" class="btn btn-primary">updatepack</button>
        </form>
    </div>

    <!-- Optional: Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
