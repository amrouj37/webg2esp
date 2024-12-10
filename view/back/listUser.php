<?php
// Inclure le contrôleur UserC
include "../controller/userC.php";

// Créer une instance du contrôleur
$c = new userC();

// Initialiser un tableau pour afficher les résultats
$afficher = [];

// Vérifier si le formulaire de recherche a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnSearch'])) {
    // Récupérer la valeur du bouton de recherche
    $btnSearch = $_POST['btnSearch'];
    
    // Préparer la requête SQL pour rechercher un utilisateur par CIN
    $sql = "SELECT * FROM user WHERE cin_user = :btnSearch"; // Recherche par CIN
    
    // Se connecter à la base de données
    $db = config::getConnexion();

    try {
        // Exécuter la requête préparée
        $query = $db->prepare($sql);
        $query->bindParam(':btnSearch', $btnSearch, PDO::PARAM_STR);
        $query->execute();

        // Récupérer tous les résultats
        $afficher = $query->fetchAll();
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
} else {
    // Si aucune recherche n'est effectuée, afficher tous les utilisateurs
    $afficher = $c->getUser(); // Methode pour obtenir tous les utilisateurs
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
</head>
<body>
<form method="POST" action="listUser.php">
        <input type="text" name="btnSearch" placeholder="Rechercher par CIN" required>
        <button type="submit">Rechercher</button>
    </form>

    <!-- Tableau des utilisateurs -->
    <table class="table">
        <thead>
            <tr>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Numéro</th>
                <th>Mot de passe</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Vérifier s'il y a des utilisateurs à afficher
            if (!empty($afficher)) {
                foreach ($afficher as $user) {
                    echo "<tr>
                        <td>" . htmlspecialchars($user['cin_user']) . "</td>
                        <td>" . htmlspecialchars($user['nom_user']) . "</td>
                        <td>" . htmlspecialchars($user['prenom_user']) . "</td>
                        <td>" . htmlspecialchars($user['email_user']) . "</td>
                        <td>" . htmlspecialchars($user['adress_user']) . "</td>
                        <td>" . htmlspecialchars($user['num_user']) . "</td>
                        <td>" . htmlspecialchars($user['pwd_user']) . "</td>
                        <td>" . htmlspecialchars($user['role_user']) . "</td>
                        <td>
                            <a href='update_user.php?id_user=" . urlencode($user['cin_user']) . "' class='btn btn-sm btn-primary'>Mettre à jour</a>
                            <a href='deleteUser.php?id_user=" . urlencode($user['cin_user']) . "' class='btn btn-sm btn-danger'>Supprimer</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Aucun utilisateur trouvé.</td></tr>";
            }
            ?>
        </tbody>
        </table>
    </div>
</body>
</html>
