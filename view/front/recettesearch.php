<?php
require_once 'C:\xampp\htdocs\QQQQQ\controller\recettecontroller.php';
$recetteController = new RecetteController();
$recettes = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['ingredients'])) {
    $ingredients = explode(',', $_POST['ingredients']);
    $ingredients = array_map('trim', $ingredients); // Trim whitespace
    $recettes = $recetteController->getrecettesbyingredients($ingredients);
} else {
    $recettes = $recetteController->getRecettes();
}
?>

<div class="row">
  <!-- Section Header -->
  <div class="section-header d-flex flex-wrap justify-content-between my-4">
    <h2 class="section-title">Recettes by notre Chef</h2>
    <div class="d-flex align-items-center">
      <a href="#" class="btn btn-primary rounded-1">View All</a>
    </div>
  </div>

  <!-- Search Form -->
  <div class="w-100 mb-4">
    <form method="POST" action="" class="d-flex justify-content-center">
      <input 
        type="text" 
        name="ingredients" 
        class="form-control w-50" 
        placeholder="Search by ingredients (comma-separated)" 
        value="<?= htmlspecialchars($_POST['ingredients'] ?? ''); ?>" 
        required
      >
      <button type="submit" class="btn btn-primary mx-2">Search</button>
    </form>
  </div>
  <div class="d-flex justify-content-center mb-4">
    <img 
      src="img/cooking.gif" 
      class="img-fluid" 
      style="width: 400px; height: 400px;" 
      alt="Cooking GIF"
    >
  </div>
  <?php if (!empty($recettes)): ?>
    <?php foreach ($recettes as $recette): ?>
      <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <h5 class="card-title"><?= htmlspecialchars($recette['nom_recette']); ?></h5>
            <p class="card-text">Nombre d'ingredients: <?= number_format($recette['nombre_ing'], 0); ?> </p>
            <p class="card-text"><?= htmlspecialchars($recette['instructions_recette']); ?></p>
            <button type="button" class="btn btn-primary">Save Recette</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center">
      <p>No recipes found with the specified ingredients.</p>
    </div>
  <?php endif; ?>
</div>
