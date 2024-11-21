document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        let valid = true;
        let errors = [];
        const nomRecette = document.getElementById('nom_recette');
        if (nomRecette.value.trim() === '') {
            errors.push('Nom de la recette est requis');
            valid = false;
        } else if (nomRecette.value.length < 1 || nomRecette.value.length > 50) {
            errors.push('Nom de la recette doit contenir entre 1 et 50 caractères');
            valid = false;
        }
        const nombreIng = document.getElementById('nombre_ing');
        if (nombreIng.value <= 0 || nombreIng.value > 20) {
            errors.push('Nombre d\'ingrédients doit être supérieur à zéro et inférieur ou égal à 20');
            valid = false;
        }
        const instructionsRecette = document.getElementById('instructions_recette');
        if (instructionsRecette.value.trim() === '') {
            errors.push('Les instructions sont requises');
            valid = false;
        } else if (instructionsRecette.value.length < 10 || instructionsRecette.value.length > 80) {
            errors.push('Les instructions doivent contenir entre 10 et 80 caractères');
            valid = false;
        }
        if (!valid) {
            event.preventDefault();
            alert(errors.join('\n'));
        }
    });
});
