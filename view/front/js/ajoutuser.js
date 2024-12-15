document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Récupérer les champs
        const prenomUser = document.getElementById("prenom_user").value.trim();
        const nomUser = document.getElementById("nom_user").value.trim();
        const cinUser = document.getElementById("cin_user").value.trim();
        const emailUser = document.getElementById("email_user").value.trim();
        const addressUser = document.getElementById("address_user").value.trim();
        const numUser = document.getElementById("num_user").value.trim();
        const pwdUser = document.getElementById("pwd_user").value.trim();

        // Réinitialiser les messages d'erreur
        document.getElementById("prenom_error").innerHTML = "";
        document.getElementById("nom_error").innerHTML = "";
        document.getElementById("cin_error").innerHTML = "";
        document.getElementById("email_error").innerHTML = "";
        document.getElementById("num_error").innerHTML = "";
        document.getElementById("pwd_error").innerHTML = "";

        // Validation des champs
        // Prénom : lettres uniquement
        if (!/^[a-zA-Z]+$/.test(prenomUser)) {
            document.getElementById("prenom_error").innerHTML = "Le prénom doit contenir uniquement des lettres.";
            valid = false;
        }

        // Nom : lettres uniquement
        if (!/^[a-zA-Z]+$/.test(nomUser)) {
            document.getElementById("nom_error").innerHTML = "Le nom doit contenir uniquement des lettres.";
            valid = false;
        }

        // CIN : 8 chiffres
        if (!/^\d{8}$/.test(cinUser)) {
            document.getElementById("cin_error").innerHTML = "Le CIN doit contenir exactement 8 chiffres.";
            valid = false;
        }

        // Email : format valide
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailUser)) {
            document.getElementById("email_error").innerHTML = "Veuillez saisir une adresse email valide (ex: name@gmail.com).";
            valid = false;
        }

        // Numéro de téléphone : 8 chiffres
        if (!/^\d{8}$/.test(numUser)) {
            document.getElementById("num_error").innerHTML = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
            valid = false;
        }

        // Mot de passe : au moins 7 caractères, lettres et chiffres
        if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{7,}$/.test(pwdUser)) {
            document.getElementById("pwd_error").innerHTML = "Le mot de passe doit contenir au moins 7 caractères avec des lettres et des chiffres.";
            valid = false;
        }

        // Empêche la soumission du formulaire si des champs sont invalides
        if (!valid) {
            e.preventDefault();
        }
    });
});
