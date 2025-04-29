/** 
 * Valide le formulaire d'inscription du praticien avant soumission
 * @returns {boolean} True si le formulaire est valide, false sinon
 */
function isValidatedForm() {

    let errorContainer = document.getElementById('form-errors');

    errorContainer.innerHTML = '';

    let isValid = true;

    // Récupérer les champs du formulaire
    const email = document.getElementById('email').value.trim(),
        motDePasse = document.getElementById('motDePasse').value.trim(),
        captcha = document.getElementById('captcha').value.trim();

    // Vérifier les champs vides
    if (
        email === '' || motDePasse === '' || captcha === ''
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

    // Afficher ou masquer le conteneur d'erreurs selon le résultat de la validation
    errorContainer.style.display = isValid ? 'none' : 'block';

    return isValid;
}

// Ajouter un écouteur d'événement au chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById('btnAuthentif');

    submitButton.addEventListener('click', function () {

        isValidatedForm();
    });
}