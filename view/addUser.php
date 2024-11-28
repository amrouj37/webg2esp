<?php
require_once '../controller/UserC.php';
require_once '../model/user.php'; // Inclure la classe User

// Créer une instance du contrôleur
$userC = new UserC();

if (isset($_POST["cin_user"]) && isset($_POST["nom_user"]) && isset($_POST["prenom_user"]) && isset($_POST["email_user"]) && isset($_POST["adress_user"]) && isset($_POST["num_user"]) && isset($_POST["pwd_user"]) && isset($_POST["role_user"])) {
    // Vérifier si les champs sont remplis
    if (!empty($_POST["cin_user"]) && !empty($_POST["nom_user"]) && !empty($_POST["prenom_user"]) && !empty($_POST["email_user"]) && !empty($_POST["adress_user"]) && !empty($_POST["num_user"]) && !empty($_POST["pwd_user"]) && !empty($_POST["role_user"])) {
        
        // Créer un objet User
        $user = new User(
            $_POST['cin_user'],
            $_POST['nom_user'],
            $_POST['prenom_user'],
            $_POST['email_user'],
            $_POST['adress_user'],
            $_POST['num_user'],
            $_POST['pwd_user'],
            $_POST['role_user']
        );

        // Ajouter l'utilisateur à la base de données
        $userC->addUser($user);

        // Rediriger vers la page de liste des utilisateurs après l'ajout
        header('Location: index2.php');
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

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
      <form action="index2.php" method="POST">
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
                <td><label for="role_user" class="form-label">Role:</label></td>
                <td><input type="text" class="form-control rounded-0" name="role_user" id="role_user" placeholder="role" required></td>
            </tr>
          </table>
          <br>
          <!-- Submit Button -->
          <div class="d-grid">
              <button type="button" class="btn btn-submit btn-block rounded-0" onclick="window.location.href='index.php';">Return</button>
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
