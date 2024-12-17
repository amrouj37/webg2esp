<?php
require_once 'C:\xampp\htdocs\projet_adam_final\Controller\platcontroller.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$platController = new PlatController();
$plats = $platController->getPlats();
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Plates</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>List of Plates</h1>
    
    <?php if (empty($plats)): ?>
        <p>No plates found in the database.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>ID Recette</th>
                <th>Healthy</th> <!-- New column for 'is_healthy' -->
                <th>Actions</th>
            </tr>
            <?php foreach ($plats as $plat): ?>
            <tr>
                <td><?php echo htmlspecialchars($plat['id_plat']); ?></td>
                <td><?php echo htmlspecialchars($plat['nom_plat']); ?></td>
                <td><?php echo htmlspecialchars($plat['prix_plat']); ?> €</td>
                <td><?php echo htmlspecialchars($plat['id_recette']); ?></td>
                <td><?php echo $plat['is_healthy'] ? 'Yes' : 'No'; ?></td> <!-- Displaying 'is_healthy' -->
                <td>
                    <a href="updatePlate.php?id_plat=<?php echo $plat['id_plat']; ?>">Update</a>
                    <a href="deletePlate.php?id_plat=<?php echo $plat['id_plat']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="addPlate.php">Add a New Plate</a>
</body>
</html>
