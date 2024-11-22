<?php
include '../controller/userC.php';
include_once '../model/user.php';

$error = "";
$success = "";
$user = null;

// Vérifier si un ID utilisateur est fourni dans l'URL
if (isset($_GET["id_user"])) {
    $id_user = intval($_GET["id_user"]); // Assurez-vous que c'est un entier valide

    // Créer une instance du contrôleur
    $userC = new userC();

    // Récupérer les informations de l'utilisateur à mettre à jour
    $userToUpdate = $userC->getUserById($id_user);

    // Vérifier si l'utilisateur existe
    if (!$userToUpdate) {
        die("Erreur : utilisateur introuvable.");
    }

    // Vérification si les données sont présentes dans $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            isset($_POST["cin_user"]) &&
            isset($_POST["nom_user"]) &&
            isset($_POST["prenom_user"]) &&
            isset($_POST["email_user"]) &&
            isset($_POST["adress_user"]) &&
            isset($_POST["num_user"]) &&
            isset($_POST["pwd_user"]) &&
            isset($_POST["role_user"])
        ) {
            // Traitement et affichage des données du formulaire
            echo "<h3>Formulaire soumis avec succès !</h3>";
            echo "<ul>";
            echo "<li><strong>CIN:</strong> " . htmlspecialchars($_POST["cin_user"]) . "</li>";
            echo "<li><strong>Nom:</strong> " . htmlspecialchars($_POST["nom_user"]) . "</li>";
            echo "<li><strong>Prénom:</strong> " . htmlspecialchars($_POST["prenom_user"]) . "</li>";
            echo "<li><strong>Email:</strong> " . htmlspecialchars($_POST["email_user"]) . "</li>";
            echo "<li><strong>Adresse:</strong> " . htmlspecialchars($_POST["adress_user"]) . "</li>";
            echo "<li><strong>Numéro:</strong> " . htmlspecialchars($_POST["num_user"]) . "</li>";
            echo "<li><strong>Mot de passe:</strong> ********</li>"; // Ne pas afficher le mot de passe en clair
            echo "<li><strong>Rôle:</strong> " . htmlspecialchars($_POST["role_user"]) . "</li>";
            echo "</ul>";
        } else {
            echo "<p><strong>Erreur :</strong> Tous les champs doivent être remplis.</p>";
        }
    }
} else {
    echo "<p><strong>Erreur :</strong> ID utilisateur manquant dans l'URL.</p>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  
  <link rel="stylesheet" href="path/to/your/bootstrap.css">
  <style>
    /* Style pour que l'image couvre tout l'arrière-plan */
    body {
      background: url('images/arriereform.png') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
    }
    
    

   /* Styles des champs de saisie */
   .form-control, .form-select {
      height: 50px;
      font-size: 1.1em;
    }
    
    /* Bouton Submit et Return */
    .btn-submit {
      height: 60px; /* Augmente la hauteur */
      font-size: 1.2em; /* Taille de police plus grande */
      background-color: #000000; /* Noir */
      border-color: #000000; /* Bordure noire */
      color: white; /* Texte en blanc */
    }
    
    .btn-submit:hover {
      background-color: #333333; /* Gris foncé au survol */
      border-color: #333333; /* Bordure change aussi au survol */
    }


    .btn-block {
      width: 40%;
    }

    

    /* Pour la table */
    table {
      width: 100%;
    }
    td {
      padding: 10px;
      vertical-align: middle;
    }
    /* Style pour les labels */
    label {
        display: inline-block; /* Assure que le padding s'applique */
        background-color: #f0f0f0; /* Couleur de fond */
        padding: 8px 12px; /* Espacement interne */
        border-radius: 12px; /* Coins arrondis */
        font-weight: bold; /* Met le texte en gras */
        font-size: 1em; /* Taille de police */
        margin-right: 10px; /* Espacement à droite */
    }
</style>

    
  </style>
</head>

<body>
  <div class="form-container">
      <header>
          <h1 align="center">SIGN UP</h1>
      </header>
      <br>
      <br>
      <!-- Affichage des erreurs ou succès -->
      <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
      <?php endif; ?>

      <!-- Vérifier si l'utilisateur à mettre à jour existe -->
      <?php if ($userToUpdate): ?>
        <form method="POST" action="index2.php?id_user=<?php echo $id_user; ?>">
            <div>
                <label>CIN:</label>
                <input type="text" name="cin_user" value="<?php echo htmlspecialchars($userToUpdate['cin_user']); ?>" required>
            </div>
            <div>
                <label>First name:</label>
                <input type="text" name="prenom_user" value="<?php echo htmlspecialchars($userToUpdate['prenom_user']); ?>" required>
            </div>
            <div>
                <label>Last:</label>
                <input type="text" name="nom_user" value="<?php echo htmlspecialchars($userToUpdate['nom_user']); ?>" required>
            </div>
            
            <div>
                <label>Email:</label>
                <input type="email" name="email_user" value="<?php echo htmlspecialchars($userToUpdate['email_user']); ?>" required>
            </div>
            <div>
                <label>Adress:</label>
                <input type="text" name="adress_user" value="<?php echo htmlspecialchars($userToUpdate['adress_user']); ?>" required>
            </div>
            <div>
                <label>Phone number:</label>
                <input type="text" name="num_user" value="<?php echo htmlspecialchars($userToUpdate['num_user']); ?>" required>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" name="pwd_user" value="<?php echo htmlspecialchars($userToUpdate['pwd_user']); ?>"  required>
            </div>
            <div>
                <label>Role:</label>
                <input type="text" name="role_user" value="<?php echo htmlspecialchars($userToUpdate['role_user']); ?>" required>
            </div>
            <div class="d-grid">
                <button type="button" class="btn btn-submit btn-block -0" onclick="window.location.href='index2.php';">Return</button>
                <button type="submit" class="btn btn-submit btn-block rounded-0" onclick="window.location.href='index2.php';">Update</button>
            </div>
        </form>
      <?php endif; ?>
  </body>
  
</html>
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="js/ajoutuser.js"></script>
 