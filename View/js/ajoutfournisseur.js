var b = document.getElementById("ff");
b.addEventListener("click", function (event) {
    let x = true;

    const cin = document.getElementById("cin").value;
    const prenom = document.getElementById("prenom").value;
    const nom = document.getElementById("nom").value;
    const adresse = document.getElementById("adresse").value;
    const numero = document.getElementById("numero").value;
    const email = document.getElementById("email").value;

    prenom.disabled = true;
    nom.disabled = true;
    adresse.disabled = true;
    numero.disabled = true;
    email.disabled = true;

    if (!cin || !/^\d{8}$/.test(cin)) {
        alert("CIN doit être exactement 8 chiffres et ne doit pas être vide !");
        x = false;
    } else {
        prenom.disabled = false;
    }

    if (!prenom || !/^[A-Za-z]+$/.test(prenom)) {
        alert("Le prénom doit contenir uniquement des lettres et ne doit pas être vide !");
        x = false;
    } else {
        nom.disabled = false;
    }

    if (!nom || !/^[A-Za-z]+$/.test(nom)) {
        alert("Le nom doit contenir uniquement des lettres et ne doit pas être vide !");
        x = false;
    } else {
        adresse.disabled = false;
    }

    if (!adresse || adresse.length > 20) {
        alert("L'adresse ne doit pas dépasser 20 caractères et ne doit pas être vide !");
        x = false;
    } else {
        numero.disabled = false;
    }

    if (!numero || !/^\d{8}$/.test(numero)) {
        alert("Le numéro doit contenir exactement 8 chiffres et ne doit pas être vide !");
        x = false;
    } else {
        email.disabled = false;
    }

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert("Veuillez entrer une adresse email valide et ne doit pas être vide !");
        x = false;
    }

    if (!x) {
        event.preventDefault();
    }
});
