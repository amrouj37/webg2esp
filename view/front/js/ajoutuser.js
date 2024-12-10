document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    
    form.addEventListener("submit", function (e) {
        // Empêcher la soumission si une validation échoue
        let valid = true;

        // Récupération des champs
        const prenomUser = document.getElementById("prenom_user").value.trim();
        const nomUser = document.getElementById("nom_user").value.trim();
        const cinUser = document.getElementById("cin_user").value.trim();
        const emailUser = document.getElementById("email_user").value.trim();
        const addressUser = document.getElementById("address_user").value.trim();
        const numUser = document.getElementById("num_user").value.trim();
        const pwdUser = document.getElementById("pwd_user").value.trim();
        const roleUser = document.getElementById("role_user").value.trim();

        // Validation des champs
        // 1. Prénom : lettres uniquement
        if (!/^[a-zA-Z]+$/.test(prenomUser)) {
            alert(" First name must contain only letters !");
            valid = false;
        }

        // 2. Nom : lettres uniquement
        if (!/^[a-zA-Z]+$/.test(nomUser)) {
            alert(" Last name must contain only letters !");
            valid = false;
        }

        // 3. CIN : 8 chiffres uniquement
        if (!/^\d{8}$/.test(cinUser)) {
            alert("CIN must contain exactly 8 digits !");
            valid = false;
        }

        // 4. Email : format valide
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailUser)) {
            alert("Please enter a valid email address (ex: name@gmail.com).");
            valid = false;
        }

        // 5. Numéro de téléphone : 8 chiffres uniquement
        if (!/^\d{8}$/.test(numUser)) {
            alert("Pone number must contain exactly 8 digits !");
            
            valid = false;
        }

        // 6. Mot de passe : minimum 7 caractères (lettres et chiffres)
        if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{7,}$/.test(pwdUser)) {
            alert("The password must contain at least 7 characters with letters and numbers !");
            valid = false;
        }

        // 7. Rôle : lettres uniquement
        if (!/^[a-zA-Z]+$/.test(roleUser)) {
            alert("The role must contain only letters !");
            valid = false;
        }

        // Empêche la soumission si des champs sont invalides
        if (!valid) {
            e.preventDefault();
        }
    });
});
