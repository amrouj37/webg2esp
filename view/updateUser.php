<?php
require_once '../controller/userC.php';

// Vérifier si un `id_user` est passé dans l'URL

  if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    if (!is_numeric($id_user)) {
        die("Erreur : l'ID de l'utilisateur n'est pas valide.");
    }

    // Créer une instance du contrôleur
    $userC = new userC();
    $user = $userC->getUserById($id_user);
    if (!$user) {
        die("Erreur : utilisateur introuvable.");
    }
} else {
    header('Location: listUser.php');
    exit();
}

    // Récupérer les informations de l'utilisateur
    $user = $userC->getUserById($id_user);

    // Vérifier si un utilisateur a été trouvé
    if (!$user) {
        die("Erreur : utilisateur introuvable."); // Afficher une erreur si aucun utilisateur trouvé
    }
 else {
    // Rediriger vers la liste si aucun `id_user` n'est spécifié
    header('Location: listUser.php');
    exit();
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
      <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <?php if ($user): ?>
    <form method="POST" action="">
    <div>
            <label>CIN:</label>
            <input type="text" name="cin_user" value="<?= htmlspecialchars($user['cin_user']) ?>" required>
        </div>
        <div>
            <label>Nom:</label>
            <input type="text" name="nom_user" value="<?= htmlspecialchars($user['nom_user']) ?>" required>
        </div>
        <div>
            <label>Prénom:</label>
            <input type="text" name="prenom_user" value="<?= htmlspecialchars($user['prenom_user']) ?>" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email_user" value="<?= htmlspecialchars($user['email_user']) ?>" required>
        </div>
        <div>
            <label>Adresse:</label>
            <input type="text" name="adress_user" value="<?= htmlspecialchars($user['adress_user']) ?>" required>
        </div>
        <div>
            <label>Numéro:</label>
            <input type="text" name="num_user" value="<?= htmlspecialchars($user['num_user']) ?>" required>
        </div>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="pwd_user" value="<?= htmlspecialchars($user['pwd_user']) ?>" required>
        </div>
        <div>
            <label>Rôle:</label>
            <input type="text" name="role_user" value="<?= htmlspecialchars($user['role_user']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php endif; ?>
          </table>
          <br>
          <!-- Submit Button -->
          <div class="d-grid">
              <button type="button" class="btn btn-submit btn-block rounded-0" onclick="window.location.href='index.html';">Return</button>
              <button  type="submit" class="btn btn-submit btn-block rounded-0">Submit</button>
                       
   
                       
                   
          </div>
      </form>
  </div>
  </body>
  
</html>
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="js/ajoutuser.js"></script>
