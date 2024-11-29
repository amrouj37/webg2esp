document.querySelector(".btn-success").addEventListener("click", function (e) {
  let isValid = true;

  // Get form elements
  const quantite = document.getElementById("quantite");
  const prixUnitaire = document.getElementById("prix_unitaire");
  const dateAjout = document.getElementById("date_ajout");

  // Clear previous error messages
  document.querySelectorAll(".error").forEach(el => el.remove());

  // Validate Quantité
  if (quantite.value.trim() === "" || isNaN(quantite.value) || quantite.value <= 0) {
      alert("Quantité doit être un nombre positif.");
      isValid = false;
  }

  // Validate Prix Unitaire
  if (prixUnitaire.value.trim() === "" || !["Item 1", "Item 2", "Item 3"].includes(prixUnitaire.value)) {
    alert("Veuillez sélectionner un item valide (Item 1, Item 2, ou Item 3).");
    isValid = false;
  }

  // Validate Date Ajout
  if (dateAjout.value.trim() === "") {
      alert("La Date d'ajout est requise.");
      isValid = false;
  }

  // If all validations pass, allow form submission
  if (!isValid) {
      e.preventDefault(); // Prevent submission only if validation fails
  }
});
