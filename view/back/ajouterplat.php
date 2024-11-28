<?php
require_once 'C:\xampp\htdocs\QQQQQ\connection.php';
require_once 'C:\xampp\htdocs\QQQQQ\controller\platcontroller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_plat = htmlspecialchars(trim($_POST['nom_plat']));
    $prix_plat = htmlspecialchars(trim($_POST['prix_plat']));
    $id_recette = htmlspecialchars(trim($_POST['id_recette']));
    $url_img = htmlspecialchars(trim($_POST['url_img'])); 

    if (empty($nom_plat) || empty($prix_plat) || empty($id_recette) || empty($url_img)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        $plat = [
            'nom_plat' => $nom_plat,
            'prix_plat' => $prix_plat,
            'id_recette' => $id_recette,
            'url_img' => $url_img,
        ];
        $platController = new PlatController();
        $platController->ajouterPlat($plat);
    }
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meconteme="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Ajouter un Plat</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Ajouter un Plat</h1>
                  </div>
                  <form method="POST" action="ajouterplat.php">
    <div class="form-group">
        <label>Nom Plat</label>
        <input type="text" class="form-control" name="nom_plat" placeholder="Enter Nom Plat" required>
    </div>
    <div class="form-group">
        <label>Prix Plat</label>
        <input type="number" class="form-control" name="prix_plat" placeholder="Prix Plat" required>
    </div>
    <div class="form-group">
        <label>Recette ID</label>
        <input type="number" class="form-control" name="id_recette" placeholder="Recette ID" required>
    </div>
    <div class="form-group">
        <label>URL IMG</label>
        <input type="text" class="form-control" name="url_img" placeholder="URL Image" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Ajouter Plat</button>
    </div>
    <hr>
</form>
                  <hr>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js\valid2.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>
