var b = document.getElementById("fs");
b.addEventListener("click", function (event) {
    let x = true;

    const nom_produit = document.getElementById("nom_produit").value;
    const quantite= document.getElementById("quantite").value;
    const unite= document.getElementById("unite").value;
    const prix_uni = document.getElementById("prix_uni").value;
    const id_four= document.getElementById("id_four").value;
    const dispo = document.getElementById("dispo").value;

    quantite.disabled = true;
    unite.disabled = true;
    prix_uni.disabled = true;
    id_four.disabled = true;
    dispo.disabled = true;

    if (!nom_produit || !/^[A-Za-z]+$/.test(nom_produit)) {
        alert("Nom du produit est composé que des lettres !");
        x = false;
    } else {
        quantite.disabled = false;
    }

    if (!quantite|| quantite <= 0 || isNaN(quantite)) {
        alert("Quantité est supérieure ou égale à 0 !");
        x = false;
    } else {
        unite.disabled = false;
    }

    if (!unite || !/^[A-Za-z]+$/.test(unite)) {
        alert("unité est composée uniquement des lettres !");
        x = false;
    } else {
        prix_uni.disabled = false;
    }
    const floatRegex = /^-?\d+(\.\d+)?$/;
    if (!prix_uni || (!floatRegex.test(prix_uni)) ) {
        alert("veuillez saisir un prix valide");
        x = false;
    } else {
        dispo.disabled = false;
    }
    if (!id_four) {
        alert("veuillez saisir id fournisseur");
        x = false;
    } else {
        dispo.disabled = false;
    }

    if (!dispo || !/^(Oui|Non)$/.test(dispo)) {
        alert("La disponibilité est soit Oui soit Non");
        x = false;
    } 
    if (!x) {
        event.preventDefault();
    }
});
