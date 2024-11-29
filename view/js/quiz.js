function validerFormulaire(inputs) {
    let erreurs = [];

    // Validation de l'âge
    const age = parseFloat(inputs.age);
    if (isNaN(age) || age <= 0) {
        erreurs.push("L'âge doit être un nombre positif et non nul.");
    }

    // Validation du poids
    const poids = parseFloat(inputs.poids);
    if (isNaN(poids) || poids <= 0) {
        erreurs.push("Le poids doit être un nombre positif et non nul.");
    }

    // Afficher les résultats
    if (erreurs.length > 0) {
        console.log("Validation échouée avec les erreurs suivantes :");
        erreurs.forEach((erreur) => console.log(erreur));
        return false;
    } else {
        console.log("Validation réussie !");
        return true;
    }
}

// Appeler la fonction de validation
validerFormulaire(inputs);
