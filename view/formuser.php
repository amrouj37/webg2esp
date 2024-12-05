<?php
// Inclure le fichier de connexion à la base de données
require_once '../config.php';
session_start(); // Démarrer la session

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $cin_user = $_POST['cin_user'];
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $email_user = $_POST['email_user'];
    $adress_user = $_POST['address_user']; // Corrigé ici pour correspondre à l'attribut du formulaire
    $num_user = $_POST['num_user'];
    $pwd_user = $_POST['pwd_user'];

    // Définir le rôle en fonction du prénom
    if (strtoupper(trim($prenom_user)) === 'AICHA') {
        $role_user = 'admin';
    } else {
        $role_user = 'client'; // Rôle par défaut
    }

    // Préparer la requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO user (cin_user, nom_user, prenom_user, email_user, adress_user, num_user, pwd_user, role_user) 
            VALUES (:cin_user, :nom_user, :prenom_user, :email_user, :adress_user, :num_user, :pwd_user, :role_user)";

    try {
        // Préparer et exécuter la requête
        $stmt = config::getConnexion()->prepare($sql);
        $stmt->execute([
            ':cin_user' => $cin_user,
            ':nom_user' => $nom_user,
            ':prenom_user' => $prenom_user,
            ':email_user' => $email_user,
            ':adress_user' => $adress_user,
            ':num_user' => $num_user,
            ':pwd_user' => password_hash($pwd_user, PASSWORD_DEFAULT), // Hachage du mot de passe
            ':role_user' => $role_user
        ]);

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
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
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
    
    
    

    /* Pour la table */
    table {
      width: 100%;
    }
    td {
      padding: 10px;
      vertical-align: middle;
    }
/* Styles personnalisés pour les boutons */
.btn-custom {
  background-color: #000000; /* Noir */
  color: white; /* Couleur du texte */
  font-size: 1.2em; /* Taille du texte */
  height: 60px; /* Hauteur */
  width: 200px; /* Largeur */
  border-radius: 30px; /* Coins arrondis */
  border: none; /* Sans bordure */
  transition: background-color 0.3s, color 0.3s; /* Animation douce */
}

.btn-custom:hover {
  background-color: #333333; /* Noir plus clair au survol */
  color: #f8f9fa; /* Blanc cassé pour le texte */
}

.btn-container {
  display: flex;
  justify-content: center; /* Centrer les boutons */
  gap: 20px; /* Espace entre les boutons */
}


  </style>

    
  
</head>

<body>
  <div class="form-container">
      <header>
        <br>
          <h1 align="center">SIGN UP</h1>
      </header>
      
      <br>
      <form action="formuser.php" method="POST" >
          <table>
              <tr>
                  <td><label for="prenom_user" class="form-label">First Name:</label></td>
                  <td><input type="text" class="form-control rounded-0" name="prenom_user" id="prenom_user" placeholder="first Name" required></td>
              </tr>
              <tr>
                <td><label for="nom_user" class="form-label">last Name:</label></td>
                <td><input type="text" class="form-control rounded-0" name="nom_user" id="nom_user" placeholder="last Name" required></td>
            </tr>
              <tr>
                  <td><label for="cin_user" class="form-label">CIN:</label></td>
                  <td><input type="text" class="form-control rounded-0" name="cin_user" id="cin_user" placeholder="CIN" required></td>
              </tr>
              <tr>
                  <td><label for="email_user" class="form-label">Email:</label></td>
                  <td><input type="email" class="form-control rounded-0" name="email_user" id="email_user" placeholder="Name@gmail.com" required></td>
              </tr>
              <tr>
                  <td><label for="address_user" class="form-label">Address:</label></td>
                  <td><input type="text" class="form-control rounded-0" name="address_user" id="address_user" placeholder="Address" required ></td>
              </tr>
              <tr>
                  <td><label for="num_user" class="form-label">Phone Number:</label></td>
                  <td><input type="tel" class="form-control rounded-0" name="num_user" id="num_user" placeholder="Phone Number" required></td>
              </tr>
              <tr>
                  <td><label for="pwd_user" class="form-label">Password:</label></td>
                  <td><input type="password" class="form-control rounded-0" name="pwd_user" id="pwd_user" placeholder="Password" required></td>
              </tr>
              <tr>
  <td>
    
  </td>
  <td>
    
  </td>
</tr>

          </table>
          <br>
          <!-- Submit Button -->
          <div class="btn-container">
        <button type="button" class="btn btn-custom" onclick="window.location.href='index.php';">Return</button>
        <button type="submit" class="btn btn-custom">Submit</button>
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
