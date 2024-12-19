<?php
// Inclure le fichier userC.php pour accéder à la fonction d'exportation
include_once 'C:\xampp\htdocs\projet_adam_final\Controller\userC.php';

// Créer une instance de la classe userC
$userController = new userC();

// Récupérer les données des utilisateurs
date_default_timezone_set('UTC');
$users = $userController->getAllUsers(); // Méthode pour obtenir les utilisateurs

// En-têtes HTTP pour la génération d'un fichier Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="saha_prep' . date('Y-m-d_H-i-s') . 'index.xls"');
header('Cache-Control: max-age=0');

// Début de la table HTML
echo "<table border='1'>";

// En-tête du tableau
echo "<tr>
        <th>CIN</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Role</th>
      </tr>";

// Remplir les données des utilisateurs
if (!empty($users)) {
    foreach ($users as $user) {
        echo "<tr>
                <td>" . htmlspecialchars($user['cin_user']) . "</td>
                <td>" . htmlspecialchars($user['prenom_user']) . "</td>
                <td>" . htmlspecialchars($user['nom_user']) . "</td>
                <td>" . htmlspecialchars($user['email_user']) . "</td>
                <td>" . htmlspecialchars($user['adress_user']) . "</td>
                <td>" . htmlspecialchars($user['num_user']) . "</td>
                <td>" . htmlspecialchars($user['role_user']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No users found.</td></tr>";
}

// Fin de la table HTML
echo "</table>";

exit;
?>
