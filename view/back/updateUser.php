<?php
include 'C:\xampp\htdocs\projectA\controller\userC.php';
include_once 'C:\xampp\htdocs\projectA\model\user.php';

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
            // Crypter le mot de passe avant de l'utiliser
            $hashed_password = password_hash($_POST["pwd_user"], PASSWORD_BCRYPT);
    
            // Afficher un message de confirmation avec les données (mot de passe crypté non affiché)
            echo "<h3>Formulaire soumis avec succès !</h3>";
            echo "<ul>";
            echo "<li><strong>CIN:</strong> " . htmlspecialchars($_POST["cin_user"]) . "</li>";
            echo "<li><strong>Nom:</strong> " . htmlspecialchars($_POST["nom_user"]) . "</li>";
            echo "<li><strong>Prénom:</strong> " . htmlspecialchars($_POST["prenom_user"]) . "</li>";
            echo "<li><strong>Email:</strong> " . htmlspecialchars($_POST["email_user"]) . "</li>";
            echo "<li><strong>Adresse:</strong> " . htmlspecialchars($_POST["adress_user"]) . "</li>";
            echo "<li><strong>Numéro:</strong> " . htmlspecialchars($_POST["num_user"]) . "</li>";
            echo "<li><strong>Mot de passe:</strong> ********</li>"; // Masqué
            echo "<li><strong>Rôle:</strong> " . htmlspecialchars($_POST["role_user"]) . "</li>";
            echo "</ul>";
    
            // Ajouter ou mettre à jour les données utilisateur avec le mot de passe crypté
            $userC->updateUser(
                $id_user,
                $_POST["cin_user"],
                $_POST["nom_user"],
                $_POST["prenom_user"],
                $_POST["email_user"],
                $_POST["adress_user"],
                $_POST["num_user"],
                $hashed_password, // Utilisation du mot de passe crypté
                $_POST["role_user"]
            );
    
            echo "<p>Mise à jour réussie avec mot de passe sécurisé.</p>";
        } else {
            echo "<p><strong>Erreur :</strong> Tous les champs doivent être remplis.</p>";
        }
    }
} // <-- Cette accolade fermante manquait !
?>







  <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Register</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-6"> UPDATE </h1>
                  </div>
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
                    <div class="form-group">
                      <label>First Name</label>
                      <br>
                      <input type="text" class="form-control" name="prenom_user" value="<?php echo htmlspecialchars($userToUpdate['prenom_user']); ?>" required >
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <br>
                      <input type="text" class="form-control" name="nom_user" value="<?php echo htmlspecialchars($userToUpdate['nom_user']); ?>" required >
                    </div>
                    <div class="form-group">
                      <label>CIN</label>
                      <br>
                      <input  type="text" class="form-control" name="cin_user" value="<?php echo htmlspecialchars($userToUpdate['cin_user']); ?>" required >
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control"  aria-describedby="emailHelp" name="email_user" value="<?php echo htmlspecialchars($userToUpdate['email_user']); ?>" required>
                    </div>
                    <div class="form-group">
                    <label>Adress</label>
                      <input type="text" class="form-control"  name="adress_user" value="<?php echo htmlspecialchars($userToUpdate['adress_user']); ?>" required >
                    </div>
                    <div class="form-group">
                    <label>Phone Number</label>
                      <input type="text" class="form-control"  name="num_user" value="<?php echo htmlspecialchars($userToUpdate['num_user']); ?>" required >
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control"  placeholder="Password" name="pwd_user" value="<?php echo htmlspecialchars($userToUpdate['pwd_user']); ?>"  required>
                    </div>
                    <div class="form-group">
                      <label>Role </label>
                      <input type="text" class="form-control" name="role_user" value="<?php echo htmlspecialchars($userToUpdate['role_user']); ?>" required  >
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block"  onclick="window.location.href='index2.php';">update</button>
                    </div>
                    <hr>
                    
                    <a href="index2.php" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i>
                    </a>
                  </form>
                  <?php endif; ?>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="login.html">Already have an account?</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="js/ajoutuser.js"></script>
</body>

</html>
 