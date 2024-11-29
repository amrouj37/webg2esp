function validateForm(e) {
    const age = document.getElementById('age').value;
    const weight = document.getElementById('weight').value;

    // Valider l'âge et le poids
    if (!validateAge(age) || !validateWeight(weight)) {
        e.preventDefault(); // Annuler l'envoi du formulaire si la validation échoue
    }
}

function validateAge(age) {
    if (age <= 0 || age === '') {
        alert('L\'âge doit être une valeur positive.');
        return false;
    }
    return true;
}

function validateWeight(weight) {
    if (weight <= 0 || weight === '') {
        alert('Le poids doit être une valeur positive.');
        return false;
    }
    return true;
}
