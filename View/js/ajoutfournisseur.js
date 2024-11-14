// function verification_cin(id) {
//     var b = document.getElementById(id);
//     var regex = /^\d{8}$/;
    
//     if (!regex.test(b.value)) {
//         alert("CIN est formée de 8 chiffres !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);
        
//         return false;
//     }

//     return true;
// }

// function verification_nom(id) {
//     var b = document.getElementById(id);
//     var regex = /^[A-Za-z]+$/;
    
//     if (!regex.test(b.value)) {
//         alert("Nom comporte seulement des lettres en majuscule et en minuscule !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);
        
//         return false;
//     }

//     return true;
// }

// function verification_prenom(id) {
//     var b = document.getElementById(id);
//     var regex = /^[A-Za-z]+$/;
    
//     if (!regex.test(b.value)) {
//         alert("prénom comporte seulement des lettres en majuscule et en minuscule !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);
        
//         return false;
//     }

//     return true;
// }


// function verification_adresse(id){
//     var b = document.getElementById(id);
//     var c=b.value;
//     var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if(20<c.length)
//     {
//         alert("adresse max 20 caractères !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);
        
//         return false;

//     }
//     if (!emailPattern.test(c)) {
//         alert("Veuillez entrer une adresse email valide !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);

//         return false;
//     }
//     return true;

// }
// function verification_numero(id){
//     var b = document.getElementById(id);
//     var c=b.value;
//     pattern=/^\d{8}$/;
    
//     if(!pattern.test(c))
//     {
//         alert("numéro exactement 8 chiffres !");
        
//         setTimeout(function() {b.focus();}, 0);
//         return false;

//     }
    
//     return true;

// }
// function verification_email(id){
//     var b = document.getElementById(id);
//     var c=b.value;
//     var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
   
//     if (!emailPattern.test(c)) {
//         alert("Veuillez entrer une adresse email valide !");
        
//         setTimeout(function() {
//             b.focus();
//         }, 0);

//         return false;
//     }
//     return true;

// }
const form = document.getElementById('form');
const cin = document.getElementById('cin');
const email = document.getElementById('email');
const nom = document.getElementById('nom');
const prenom= document.getElementById('prenom');
const adresse= document.getElementById('adresse');

form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
    const cinvalue = cin.value.trim();
    const emailvalue = email.value.trim();
    const nomvalue = nom.value.trim();
    const prenomValue = prenom.value.trim();

    if(cinvalue === '') {
        setError(cin, 'cin is required');
    } else {
        setSuccess(cinvalue);
    }

    if(emailvalue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }

    if(nomvalue === '') {
        setError(nomvalue, 'Password is required');
    } else if (nomvalue.length < 8 ) {
        setError(nomvalue, 'Entrer un nom valide')
    } else {
        setSuccess(nomvalue);
    }

    if(prenomvalue === '') {
        setError(prenomvalue, 'Entrer un nom valide');
    } else {
        setSuccess(prenomvalue);
    }

};