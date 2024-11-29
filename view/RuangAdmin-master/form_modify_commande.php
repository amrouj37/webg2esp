<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Create Commande</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <script src="../../view/creecommande.js" defer></script>
</head>

<body id="page-top">
  <div id="wrapper">

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Commande</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Modifier Commande</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Commande Form</h6>
                </div>
                <div class="card-body">
                <form action="../update_commande.php" method="POST">
                  <input type="hidden" name="id_commande" value="<?= $commande['id_commande'] ?>">

                  <div class="form-group">
                      <label for="date_commande">Date Commande:</label>
                      <input type="date" name="date_commande" id="date_commande" value="<?= $commande['date_commande'] ?>" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="adresse_livraison">Adresse Livraison:</label>
                      <input type="text" name="adresse_livraison" id="adresse_livraison" value="<?= $commande['adresse_livraison'] ?>" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="adresse_facturation">Adresse Facturation:</label>
                      <input type="text" name="adresse_facturation" id="adresse_facturation" value="<?= $commande['adresse_facturation'] ?>" class="form-control">
                  </div>

                  

                  <button type="submit" class="btn btn-primary">Update Commande</button>
                  <a href="../view/RuangAdmin-master/simple-tables.php" class="btn btn-secondary">Cancel</a>
                </form>

                </div>
              </div>
          </div>
        </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>

</body>

</html>
