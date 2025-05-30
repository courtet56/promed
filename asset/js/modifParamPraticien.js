function isValidatedForm() {
    // Erreur container :
    let errorContainer = document.getElementById('form-errors');
    errorContainer.innerHTML = '';

    // Succes container :
    let successContainer = document.getElementById('form-success');
    successContainer.innerHTML = '';

    // Information container:
    let infoContainer = document.getElementById('form-info');
    infoContainer.innerHTML = '';



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
     adeli = document.getElementById('adeli').value.trim()
     oldMdp = document.getElementById('ancienMotDePasse').value.trim(),
     newMdp = document.getElementById('nouveauMotDePasse').value.trim();
    
    // Vérifier les champs vides


     if (
        nom === '' || prenom === '' 
        || activite === '' || numero === '' 
        || rue === '' ||codePostal === '' 
        || ville === '' || pays === '' 
        || email === '' || adeli === ''
        
    ) { 
        errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Veuillez remplir tous les champs obligatoires.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }

    // Vérifier le format de l'email
    // Vérifier si le champ est vide
    if (email === '') {
        let errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Le champ email est obligatoire.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        let errorParagraph = document.createElement('p');
        errorParagraph.textContent = 'Veuillez saisir un email correct.';
        errorContainer.appendChild(errorParagraph);
        isValid = false;
    }

     // Si les deux champs de mot de passe sont remplis, validez le nouveau mot de passe côté client
     if (oldMdp !== '' && newMdp !== '') {
        // Vérifier la longueur du mot de passe
        if (newMdp.length < 8) {
            let errorParagraph = document.createElement('p');
            errorParagraph.textContent = 'Le nouveau mot de passe doit contenir au moins 8 caractères.';
            errorContainer.appendChild(errorParagraph);
            isValid = false;
        }
        
        // Vérifier si le mot de passe contient au moins un chiffre
        if (!/[0-9]/.test(newMdp)) {
            let errorParagraph = document.createElement('p');
            errorParagraph.textContent = 'Le mot de passe doit contenir au moins un chiffre.';
            errorContainer.appendChild(errorParagraph);
            isValid = false;
        }
        
        // Vérifier si le mot de passe contient au moins une minuscule
        if (!/[a-z]/.test(newMdp)) {
            let errorParagraph = document.createElement('p');
            errorParagraph.textContent = 'Le mot de passe doit contenir au moins une lettre minuscule.';
            errorContainer.appendChild(errorParagraph);
            isValid = false;
        }
        
        // Vérifier si le mot de passe contient au moins une majuscule
        if (!/[A-Z]/.test(newMdp)) {
            let errorParagraph = document.createElement('p');
            errorParagraph.textContent = 'Le mot de passe doit contenir au moins une lettre majuscule.';
            errorContainer.appendChild(errorParagraph);
            isValid = false;
        }
        
        // Vérifier si le mot de passe contient au moins un caractère spécial
        if (!/[!@#$%^&*()_+]/.test(newMdp)) {
            let errorParagraph = document.createElement('p');
            errorParagraph.textContent = 'Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*()_+).';
            errorContainer.appendChild(errorParagraph);
            isValid = false;
        }
    }
    
    errorContainer.style.display = isValid ? 'none' : 'block';

    return isValid;
}

function getFormData() {
    const fieldNames = [
        'nom', 'prenom', 'activite', 'numero', 'rue',
        'codePostal', 'ville', 'pays', 'email', 'adeli',
        'ancienMotDePasse', 'nouveauMotDePasse',
    ];

    const formData = {};

    for (let i = 0; i < fieldNames.length; i++) {
        const field = fieldNames[i];
        const element = document.getElementById(field);

        if (element) {
            formData[field] = element.value.trim();
        }
    }

    return formData;
}

document.addEventListener('DOMContentLoaded', function () {
    

    let submitButton = document.getElementById('btnModifier');
    if(submitButton){
        submitButton.addEventListener('click', function () {
        if (isValidatedForm()) 
            {
                const formDataObj = getFormData();

                const ajaxUrl = 'ajax?modifyPraticien';

                const request = new AjaxRequest(ajaxUrl, 'POST', formDataObj, true);
                request.send(
                    (response) => 
                    {
                        // Traiter tous les messages d'erreur possibles liés au mot de passe
                        if (response.includes("Mot de passe trop court") || 
                         response.includes("doit contenir au moins un chiffre") ||
                         response.includes("doit contenir au moins une minuscule") ||
                         response.includes("doit contenir au moins une majuscule") ||
                         response.includes("doit contenir au moins un caractère spécial") ||
                         response.includes("L'ancien mot de passe est incorrect")) 
                        {
                            // Afficher le message d'erreur dans le conteneur d'erreurs
                            let errorContainer = document.getElementById('form-errors');
                            errorContainer.innerHTML = ''; // Effacer les erreurs précédentes
                            let errorParagraph = document.createElement('p');
                            errorParagraph.textContent = response;
                            errorContainer.appendChild(errorParagraph);
                            errorContainer.style.display = 'block';
                        }
                        if (response === "Modification effectuée !" )
                        {
                            let successContainer = document.getElementById('form-success');
                            successContainer.innerHTML = '';
                            let successParagraph = document.createElement('p');
                            successParagraph.textContent = response;
                            successContainer.appendChild(successParagraph);
                            successContainer.style.display = 'block';
                        } 

                        else if(response === "Adeli déjà utilisé !")
                        {
                            let errorContainer = document.getElementById('form-errors');
                            errorContainer.innerHTML = ''; // Effacer les erreurs précédentes
                            let errorParagraph = document.createElement('p');
                            errorParagraph.textContent = response;
                            errorContainer.appendChild(errorParagraph);
                            errorContainer.style.display = 'block';
                        }
                        else if(response === "Email déjà utilisé !")
                        {
                            let errorContainer = document.getElementById('form-errors');
                            errorContainer.innerHTML = ''; // Effacer les erreurs précédentes
                            let errorParagraph = document.createElement('p');
                            errorParagraph.textContent = response;
                            errorContainer.appendChild(errorParagraph);
                            errorContainer.style.display = 'block';
                        } 
                        else if(response === "Aucune modification effectuée !"){
                            let infoContainer = document.getElementById('form-info');
                            infoContainer.innerHTML = '';
                            let infoParagraph = document.createElement('p');
                            infoParagraph.textContent = response;
                            infoContainer.appendChild(infoParagraph);
                            infoContainer.style.display = 'block';
                        }
                        else if(response === "Email invalide !")
                        {
                            alert(response);
                        }
                    },  
                    
                    () => {


                    }
                );
            }
        });
    }            
});   

// Début traitement Modifications/Ajout prises en charge :


function getFormDataPresta() {
    const fieldNames = [
        'libellePrestation','dureeConsultation', 'prixConsultation', 'userId'
    ];

    const formDataPresta = {};

    for (let i = 0; i < fieldNames.length; i++) {
        const field = fieldNames[i];
        const element = document.getElementById(field);

        if (element) {
            formDataPresta[field] = element.value.trim();
        }
    }
    // console.log(formDataPresta);
    return formDataPresta;
}

document.addEventListener('DOMContentLoaded', function () {
    
    let submitButton = document.getElementById('btnAjouterModifierPrestation');
    submitButton.addEventListener('click', function () {

        const formData = getFormDataPresta();
        const ajaxUrl = 'ajax?ajouterModifierPrestation'
        const request = new AjaxRequest(ajaxUrl, 'POST', formData, true);
        request.send((response) => 
            {
                if (response == true)
                {
                    alert('creation ok');
                    location.reload();
                    // recupérer les datas et refaire tableau => faire une nouvelle fonction recreerTableau() et l'appeler ici
                    
                }
                else {

                    alert("Une erreur est survenue !");
                }
            }
        )
    });               



    // Ecoute du menu Select:
    let champPrix = document.getElementById('prixConsultation');
    let champDuree = document.getElementById('dureeConsultation');
    let selectPresta = document.getElementById('libellePrestation');
    selectPresta.addEventListener('change', function () {
        {
            const formData = getFormDataPresta();
    
            const ajaxUrl = 'ajax?selectPresta';
    
            const request = new AjaxRequest(ajaxUrl, 'POST', formData, true);
            request.send(
                (response) => 
                {
                    // Convertir la réponse en objet JavaScript
                    const donnees = JSON.parse(response);
                    console.log(donnees);
                    
                    if (donnees.existe === true)
                    {
                        // Changer la valeur du bouton:
                        submitButton.textContent = 'Modifier';
                        champDuree.value = donnees.duree;
                        champPrix.value = donnees.tarif;
                    }
                    else {
                        submitButton.textContent = 'Ajouter';
                        champPrix.value = "";
                        champDuree.value = "";
                    }
                },  
            );
        }
    })

    
    // Supprimer Prestation:

     $('.btnSupprimer').on('click', function() {
        const $tr = $(this).closest('tr'); // déclare un objet $tr
        const idPresta = $tr.attr('id');
        console.log($tr.attr('id'));

        let data = {'idPresta' : idPresta};
        const ajaxUrl = 'ajax?supprPresta' ;
        const request = new AjaxRequest(ajaxUrl, 'POST', data, true);
        request.send(
            (response) => 
            {
                if(response === true)
                {
                    $tr.remove();
                    alert("Suppression prestation réussie");
                }
            }
        )
    })
});

