<?php
// Inclure le fichier de connexion à la base de données
require_once 'C:\xampp\htdocs\projectA\config.php';
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email_user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$email_user = $_SESSION['email_user'];

// Préparer la requête pour récupérer les données de l'utilisateur
$sql = "SELECT * FROM user WHERE email_user = :email_user";
try {
    $stmt = config::getConnexion()->prepare($sql);
    $stmt->execute([':email_user' => $email_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si l'utilisateur existe
    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
    <style>
        body {
            background: url('images/arriereform.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .profile-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        .btn-custom {
            background-color: #000000;
            color: white;
            font-size: 1.2em;
            height: 60px;
            width: 200px;
            border-radius: 30px;
            border: none;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-custom:hover {
            background-color: #333333;
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1 class="text-center">Votre Profil</h1>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['prenom_user']); ?></p>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['nom_user']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email_user']); ?></p>
        <p><strong>Adresse :</strong> <?php echo htmlspecialchars($user['adress_user']); ?></p>
        <p><strong>Numéro de téléphone :</strong> <?php echo htmlspecialchars($user['num_user']); ?></p>
        
        <div class="text-center">
            <button class="btn btn-custom" onclick="window.location.href='index.php';">Retour</button>
        </div>
    </div>
</body>
</html>
