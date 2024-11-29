<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Form Basics</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <script src="../../view/creepanier.js" defer></script>

</head>

<body id="page-top">
  <div id="wrapper">

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Basics</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Forms</li>
              <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Basic</h6>
                </div>
                <div class="card-body">
          <form action="../create_panier.php" method="POST">
            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
            </div>
            <div class="form-group">
                <label for="prix_unitaire">Item:</label>
                <select name="prix_unitaire" id="prix_unitaire" class="form-control" required>
                            <option value="">-- Selection Plat--</option>
                            <option value="Item 1">Plat 1</option>
                            <option value="Item 2">Plat 2</option>
                            <option value="Item 3">Plat 3</option>
                        </select>
            </div>
            <div class="form-group">
                <label for="date_ajout">Date Ajout:</label>
                <input type="date" name="date_ajout" id="date_ajout" class="form-control" >
            </div>
            <button type="submit" class="btn btn-success">Add Panier</button>
            <a href="../RuangAdmin-master/simple-tables.php" class="btn btn-secondary">Cancel</a>
        </form>
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