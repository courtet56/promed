/** 
 * Valide le formulaire d'inscription du praticien avant soumission
 * @returns {boolean} True si le formulaire est valide, false sinon
 */
function isValidatedForm() {

    let errorContainer = document.getElementById('form-errors');

    errorContainer.innerHTML = '';

    let isValid = true;

    // Récupérer les champs du formulaire
    const nom = document.getElementById('nom').value.trim(),
     prenom = document.getElementById('prenom').value.trim(),
     activite = document.getElementById('activite').value.trim(),
     numero = document.getElementById('numero').value.trim(),
     rue = document.getElementById('rue').value.trim(),
     codePostal = document.getElementById('codePostal').value.trim(),
     ville = document.getElementById('ville').value.trim(),
     pays = document.getElementById('pays').value.trim(),
     email = document.getElementById('email').value.trim(),
     adeli = document.getElementById('adeli').value.trim(),
     motDePasse = document.getElementById('motDePasse').value.trim(),
     motDePasse2 = document.getElementById('motDePasse2').value.trim(),
     captcha = document.getElementById('captcha').value.trim();
    
    // Vérifier les champs vides
    if (
        nom === '' || prenom === '' || activite === '' || numero === '' || rue === '' ||
        codePostal === '' || ville === '' || pays === '' || email === '' || adeli === '' ||
        motDePasse === '' || motDePasse2 === '' || captcha === ''
    ) {
        const errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Veuillez remplir tous les champs obligatoires.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }

    // Vérifier le format de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email !== '' && !emailRegex.test(email)) {
        const errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Veuillez saisir une adresse e-mail valide.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }
    
    // Vérifier si les mots de passe correspondent
    if (motDePasse !== '' && motDePasse2 !== '' && motDePasse !== motDePasse2) {
        const errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Les mots de passe ne correspondent pas.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }
    
    // Vérifier la robustesse du mot de passe (au moins 8 caractères avec lettres et chiffres)
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d).{8,}$/;
    if (motDePasse !== '' && !passwordRegex.test(motDePasse)) {
        const errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Le mot de passe doit contenir au moins 8 caractères, dont des lettres et des chiffres.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }


    // Afficher ou masquer le conteneur d'erreurs selon le résultat de la validation
    errorContainer.style.display = isValid ? 'none' : 'block';

    return isValid;
}

/* Récupère tous les champs du formulaire dans un objet ou un tableau
 * @param {string} format - Le format de retour souhaité ('array' ou 'json')
 * @returns {Object|Array} - Les données du formulaire au format demandé
 */
function getFormData(format = 'json') {
    // Définir les champs à récupérer
    const fieldNames = [
        'nom', 
        'prenom', 
        'activite', 
        'numero', 
        'rue', 
        'codePostal', 
        'ville', 
        'pays', 
        'email', 
        'adeli', 
        'motDePasse', 
        'captcha'
    ];
    
    // Format JSON (objet)
    if (format.toLowerCase() === 'json') {
        const formData = {};
        
        // Récupérer chaque valeur et l'ajouter à l'objet
        fieldNames.forEach(fieldName => {
            const element = document.getElementById(fieldName);
            if (element) {
                formData[fieldName] = element.value.trim();
            }
        });
        
        return formData;
    }
}

// Ajouter un écouteur d'événement au chargement du DOM
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('btnInscription');
    
    // Vérifier si le bouton de soumission existe avant d'ajouter l'écouteur d'événement
    if (submitButton) {
        submitButton.addEventListener('click', function() {
            
            if (isValidatedForm()) {
                // Récupérer les données du formulaire
                 const formDataObj = getFormData('json');
                
                // Déterminer l'URL relative
                const ajaxUrl = 'ajax?newPraticien';
                
                // Créer une instance de la classe AjaxRequest
                const request = new AjaxRequest(
                    ajaxUrl,           // URL
                    'POST',            // Méthode
                    formDataObj,       // Données
                    true               // Mode debug complet (optionnel)
                );
                
                // Envoyer la requête
                request.send(
                    // Callback de succès
                    (response) => {
                        
                        if (response ==='ok') {
                            alert('Inscription réussie ! Vous allez être redirigé vers la page de connexion.');
                            window.location.href = './accueil';
                               
                        } else {
                            alert(response);
                        }
                        
                            
                    },
                    // Callback de fin de requête
                    () => {
                        
                    }
                );
                
            }
        });
    } else {
        console.error("Bouton de soumission non trouvé dans le formulaire");
    }
});