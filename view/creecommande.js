document.querySelector(".btn-success").addEventListener("click", function (e) {
  let isValid = true;

  // Get form elements
  const idClient = document.getElementById("id_client");
  const dateCommande = document.getElementById("date_commande");
  const adresseLivraison = document.getElementById("adresse_livraison");
  const adresseFacturation = document.getElementById("adresse_facturation");

  // Clear previous error messages
  document.querySelectorAll(".error").forEach(el => el.remove());

  // Validate Client ID
  if (idClient.value.trim() === "" || isNaN(idClient.value) || idClient.value <= 0) {
      alert("L'ID Client doit être un nombre positif.");
      isValid = false;
  }

  // Validate Date de Commande
  if (dateCommande.value.trim() === "") {
      alert("La Date de Commande est requise.");
      isValid = false;
  }

  // Validate Adresse de Livraison
  if (adresseLivraison.value.trim() === "") {
      alert("L'Adresse de Livraison est requise.");
      isValid = false;
  }

  // Validate Adresse de Facturation
  if (adresseFacturation.value.trim() === "") {
      alert("L'Adresse de Facturation est requise.");
      isValid = false;
  }

  // If all validations pass, allow form submission
  if (!isValid) {
      e.preventDefault(); // Prevent submission only if validation fails
  }
});
