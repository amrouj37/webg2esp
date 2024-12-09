<?php
require_once '../config.php';
require_once 'session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les informations envoyées par le formulaire
    $email_user = $_POST['email_user'];
    $pwd_user = $_POST['pwd_user'];

    // Préparer une requête SQL pour vérifier les informations utilisateur
    $sql = "SELECT prenom_user, pwd_user FROM user WHERE email_user = :email_user";

    try {
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->execute([':email_user' => $email_user]);

        // Récupérer le résultat
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifier le mot de passe
            if (password_verify($pwd_user, $user['pwd_user'])) {
                // Définir le rôle en fonction du prénom
                $prenom_user = $user['prenom_user'];
                if (strtoupper(trim($prenom_user)) === 'AICHA') {
                    $role_user = 'admin';
                } else {
                    $role_user = 'client'; // Rôle par défaut
                }

                // Sauvegarder le prénom et rôle dans une session
                $_SESSION['prenom_user'] = $prenom_user;
                $_SESSION['role_user'] = $role_user;

                // Rediriger en fonction du rôle
                if ($role_user === 'admin') {
                    header("Location: index2.php");
                } else {
                    header("Location: client.php");
                }
                exit();
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="telephone" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    
    <style>
        /* Appliquer l'arrière-plan à tout le body */
        body {
            background-image: url('images/file.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
            margin: 0;
        }

        header {
            width: 100%;
            position: fixed; /* Fixer la barre de navigation en haut */
            top: 0;
            left: 0;
            z-index: 10; /* S'assurer que la barre de navigation soit au-dessus du reste du contenu */
            padding: 10px 0;
        }

        .form-container {
    background-color: rgba(255, 255, 255, 0.8); /* Légère transparence pour le fond du formulaire */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px; /* Limiter la largeur du formulaire */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* Centre les éléments à l'intérieur verticalement */
}

button {
    width: 100%; /* Prendre toute la largeur disponible */
    max-width: 200px; /* Limiter la largeur du bouton si nécessaire */
}
        /* Changer la couleur de la bordure des inputs */
input.form-control {
    border: 2px solid #555; /* Gris foncé */
}

input.form-control:focus {
    border-color: #333; /* Couleur encore plus foncée lorsqu'il est focus */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Ajouter une légère ombre lors du focus */
}
    </style>

    <title>Login - SAHA PREP</title>
</head>

<body>
    <div class="form-container">
        <header>
            <br>
            <br>
            <br>
            <br>
            <h1 align="center">Log in</h1>
    </header>

        <form action="client.php" method="POST">
            <div class="form-group">
                <label for="email_user">Email</label>
                <input type="email" id="email_user" name="email_user" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pwd_user">Mot de passe</label>
                <input type="password" id="pwd_user" name="pwd_user" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Connexion</button>
            <p class="text-center" >
                Do you have an account ?<a href="formuser.php"> Create an account </a>
</p>
        </form>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
