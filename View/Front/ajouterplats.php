<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'C:\xampp\htdocs\projet_adam_final\config.php'; 
    require_once 'C:\xampp\htdocs\projet_adam_final\Controller\platcontroller.php';

    $platController = new PlatController();

    // Get the form data
    $plat = [
        'nom_plat' => $_POST['nom_plat'],
        'prix_plat' => $_POST['prix_plat'],
        'id_recette' => $_POST['id_recette'],
        'url_img' => $_POST['url_img'], // Assuming you have this field in the form
        'is_healthy' => isset($_POST['is_healthy']) ? true : false // This will be true if the checkbox is checked
    ];

    // Add the plat
    $platController->ajouterplat($plat);
    echo "Plat ajouté avec succès!";
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Plat</title>
</head>
<body>
    <form method="POST" action="ajouterplats.php">
        <label for="nom_plat">Nom du Plat:</label>
        <input type="text" id="nom_plat" name="nom_plat">
        <br>

        <label for="prix_plat">Prix du Plat:</label>
        <input type="number" id="prix_plat" name="prix_plat" step="0.01">
        <br>

        <label for="id_recette">ID Recette:</label>
        <input type="number" id="id_recette" name="id_recette">
        <br>

        <label for="url_img">URL de l'image:</label>
        <input type="text" id="url_img" name="url_img">
        <br>

        <label for="is_healthy">Plat sain:</label>
        <input type="checkbox" id="is_healthy" name="is_healthy">
        <br>

        <button type="submit" name="ajouter_plat">Ajouter Plat</button>
    </form>
</body>
</html>
