<?php
// Code PHP pour récupérer les données POST du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_user = htmlspecialchars($_POST['nom_user']); // Sécurisation contre les attaques XSS
    $prenom_user = htmlspecialchars($_POST['prenom_user']);
    $email_user = htmlspecialchars($_POST['email_user']);
    $cin_user = htmlspecialchars($_POST['cin_user']);
    $adress_user = htmlspecialchars($_POST['adress_user']);
    $num_user = htmlspecialchars($_POST['num_user']);
    $pwd_user = htmlspecialchars($_POST['pwd_user']); // Il est recommandé de hacher le mot de passe pour la sécurité

    // Afficher les données récupérées pour vérification (pour les besoins de démonstration)
    echo "<h2>Utilisateur créé :</h2>";
    echo "<p>Nom : " . $nom_user . "</p>";
    echo "<p>Prénom : " . $prenom_user . "</p>";
    echo "<p>Email : " . $email_user . "</p>";
    echo "<p>CIN : " . $cin_user . "</p>";
    echo "<p>Adresse : " . $adress_user . "</p>";
    echo "<p>Numéro : " . $num_user . "</p>";
    echo "<p>Mot de passe : " . $pwd_user . "</p>";

    // Ici, vous pourriez ajouter du code pour enregistrer ces données dans une base de données.
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Advanced CSS Effects</title>
    <style>
        body {
            background-color: #f8f9fa; /* Fond gris clair */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Police plus moderne */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background-color: #ffffff; /* Fond blanc pour le formulaire */
            padding: 30px;
            border-radius: 10px; /* Coins arrondis */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); /* Ombre plus profonde */
            text-align: center;
            width: 450px; /* Largeur du formulaire */
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333; /* Couleur du texte */
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; /* Largeur complète */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px; /* Taille du texte */
        }

        button {
            padding: 10px 20px;
            margin: 15px 10px; /* Espacement entre les boutons */
            border: none;
            border-radius: 5px; /* Coins arrondis */
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Animation douce */
            outline: none; /* Enlever la bordure par défaut */
        }

        button:hover {
            opacity: 0.9; /* Légère transparence au survol */
        }

        button:nth-of-type(1) {
            background-color: #dc3545; /* Couleur rouge pour le bouton CANCEL */
        }

        button:nth-of-type(1):hover {
            background-color: #c82333; /* Couleur rouge foncé au survol */
        }

        button:nth-of-type(2) {
            background-color: #28a745; /* Couleur verte pour le bouton DONE */
        }

        button:nth-of-type(2):hover {
            background-color: #218838; /* Couleur verte foncée au survol */
        }
    </style>
</head>
<body>
    <center>
        <div class="box">
            <!-- Formulaire de création de compte -->
            <form method="post" action="">
                <label for="nom_user">Nom</label>
                <input type="text" name="nom_user" placeholder="Nom" required>
                
                <label for="prenom_user">Prénom</label>
                <input type="text" name="prenom_user" placeholder="Prénom" required>
                
                <label for="email_user">Email</label>
                <input type="email" name="email_user" placeholder="Email ID" required>
                
                <label for="cin_user">CIN</label>
                <input type="text" name="cin_user" placeholder="CIN" required>
                
                <label for="adress_user">Adresse</label>
                <input type="text" name="adress_user" placeholder="Adresse" required>
                
                <label for="num_user">Numéro</label>
                <input type="text" name="num_user" placeholder="Numéro de téléphone" required>
                
                <label for="pwd_user">Mot de passe</label>
                <input type="password" name="pwd_user" placeholder="Mot de passe" required>

                <div style="display: flex; justify-content: space-between;">
                    <button type="reset" style="background-color: #dc3545;">CANCEL</button>
                    <button type="submit" style="background-color: #28a745;">DONE</button>
                </div>
            </form>
        </div>
    </center>
</body>
</html>
