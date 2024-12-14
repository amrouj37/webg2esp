<?php
session_start();
require_once 'C:\xampp\htdocs\projectA\config.php';  
require_once 'C:\xampp\htdocs\projectA\view\front\profile.php';  // Ajout du point-virgule manquant

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_user']) && isset($_SESSION['prenom_user'])) {

    try {
        // Connexion à la base de données
        $pdo = config::getConnexion();
        
        // Récupérer l'ID de l'utilisateur connecté
        $id_user = $_SESSION['id_user'];
        
        // Requête pour récupérer les données de l'utilisateur
        $sql = "SELECT id_user, cin_user,prenom_user, nom_user, email_user, pwd_user, role_user, password FROM utilisateur WHERE id_user = :id_user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        
        // Récupérer les données de l'utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Afficher les données de l'utilisateur
            // (Code d'affichage ici)
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
} else {
    echo "Veuillez vous connecter.";
}
 else {
    // Si l'utilisateur n'existe pas dans la base de données
    echo "User not found.";
}

 catch (PDOException $e) {
// En cas d'erreur avec la base de données
echo "Error: " . $e->getMessage();
}

 else {
// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
header("Location: client.php");
exit();
}

?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>User Profile</title>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f7f7f7;
                        margin: 0;
                        padding: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        color: #333;
                    }

                    .profile-container {
                        background-color: #fff;
                        border-radius: 12px;
                        padding: 30px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        width: 100%;
                        max-width: 500px;
                        box-sizing: border-box;
                    }

                    h2 {
                        text-align: center;
                        font-size: 24px;
                        color: #444;
                        margin-bottom: 20px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                    }

                    .profile-container p {
                        font-size: 16px;
                        margin-bottom: 15px;
                    }

                    .profile-container p strong {
                        color: #4CAF50;
                    }

                    .btn {
                        display: inline-block;
                        width: 100%;
                        padding: 12px;
                        background-color: #4caf50;
                        border: none;
                        border-radius: 8px;
                        color: #fff;
                        font-size: 18px;
                        font-weight: 600;
                        text-align: center;
                        cursor: pointer;
                        transition: background-color 0.3s ease, transform 0.3s ease;
                        margin-top: 20px;
                    }

                    .btn:hover {
                        background-color: #45a049;
                        transform: translateY(-3px);
                    }

                    .btn:active {
                        transform: translateY(1px);
                    }

                    .back-link {
                        display: block;
                        text-align: center;
                        margin-top: 15px;
                        font-size: 16px;
                        color: #4CAF50;
                        text-decoration: none;
                        font-weight: 600;
                    }

                    .back-link:hover {
                        text-decoration: underline;
                    }
                </style>
            </head>
            <body>
                <div class="profile-container">
                    <h2>User Profile</h2>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['prenom_user']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['DOB']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                    
                    <!-- Button to logout -->
                    <a href="client.php" class="btn">Logout</a>
                    
                    <!-- Link to return to the profile page -->
                    <a href="client.php" class="back-link">Back to Profile</a>
                </div>
            </body>
            </html>
            