document.querySelector(".btn").addEventListener("click", function (e) {
    e.preventDefault(); // Empêche l'envoi du formulaire

    let isValid = true;

    // Obtenir les valeurs des champs
    const fname = document.getElementById("fname");
    const email = document.getElementById("email");
    const address = document.getElementById("adr");
    const city = document.getElementById("city");
    const state = document.getElementById("state");
    const zip = document.getElementById("zip");
    const cardName = document.getElementById("cname");
    const cardNumber = document.getElementById("ccnum");
    const expMonth = document.getElementById("expmonth");
    const expYear = document.getElementById("expyear");
    const cvv = document.getElementById("cvv");

    // Efface les anciens messages d'erreur
    document.querySelectorAll(".error").forEach((el) => el.remove());

    // Vérifications des champs
    if (fname.value.trim() === "") {
        showError(fname, "Nom et prénom sont requis.");
        isValid = false;
    }

    if (!validateEmail(email.value)) {
        showError(email, "Veuillez entrer un email valide.");
        isValid = false;
    }

    if (address.value.trim() === "") {
        showError(address, "Adresse est requise.");
        isValid = false;
    }

    if (city.value.trim() === "") {
        showError(city, "Ville est requise.");
        isValid = false;
    }

    if (state.value.trim() === "") {
        showError(state, "État est requis.");
        isValid = false;
    }

    if (!/^\d{5}$/.test(zip.value)) {
        showError(zip, "Code postal doit être un nombre de 5 chiffres.");
        isValid = false;
    }

    if (cardName.value.trim() === "") {
        showError(cardName, "Nom sur la carte est requis.");
        isValid = false;
    }

    if (!/^\d{16}$/.test(cardNumber.value)) {
        showError(cardNumber, "Numéro de carte doit être un nombre de 16 chiffres.");
        isValid = false;
    }

    if (expMonth.value.trim() === "") {
        showError(expMonth, "Le mois d'expiration est requis.");
        isValid = false;
    }

    if (!/^\d{4}$/.test(expYear.value)) {
        showError(expYear, "L'année d'expiration doit être un nombre de 4 chiffres.");
        isValid = false;
    }

    if (!/^\d{3}$/.test(cvv.value)) {
        showError(cvv, "Le CVV doit être un nombre de 3 chiffres.");
        isValid = false;
    }

    // Si tout est valide, soumission du formulaire
    if (isValid) {
        alert("Formulaire soumis avec succès !");
        // Vous pouvez envoyer les données ici avec fetch ou autre méthode
    }
});

// Fonction pour afficher les erreurs
function showError(input, message) {
    const error = document.createElement("div");
    error.className = "error";
    error.style.color = "red";
    error.textContent = message;
    input.parentNode.appendChild(error);
}

// Fonction pour valider un email
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}