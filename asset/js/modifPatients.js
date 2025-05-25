document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.getElementsByClassName("btnSupprimer");
    const updateBtns = document.getElementsByClassName("btnModifier");
    const addBtn = document.getElementById('ajouterPatient');
    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
    let idPatient = null;
    for (let btn of deleteBtns) {
        // ajout d'un eventlistener qui ouvre la modale de confirmation de suppression quand on clique sur un bouton "supprimer"
        btn.addEventListener('click', function() {
            idPatient = this.getAttribute('info-patientId');
            const nomPatient = this.getAttribute('info-patientName');
            document.getElementById('patientName').textContent = nomPatient;
            modal.show();
        });
    }
    // au clic sur le bouton "confirmer" de la modale, on lance la suppression du patient
    const confirmBtn = document.getElementById("modalBtnConfirm");
    if(confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            // console.log(idPatient);
            supprimerPatient(idPatient)
        })
    }

    for (let btn of updateBtns) {
        // ajout d'un eventlistener qui ouvre la modale de modification du patient quand on clique sur modifier
        btn.addEventListener('click', function() {
            idPatient = this.getAttribute('info-patientId');
            getInfoPatient(idPatient);
        });
    }

    const modifValidate = document.getElementById('modifPatient');
    if(modifValidate) {
        modifValidate.addEventListener('click', function() {
            // console.log(idPatient)
            let values = getFormValues('#formModal');
            modifierPatient(idPatient, values);
        })
    }

    if(addBtn) {
        addBtn.addEventListener('click', function() {
            let values = getFormValues('#formAjoutModal');
            ajouterPatient(values);
        })
    }
});

function supprimerPatient(idPatient) {
    const ajaxUrl = "ajax?supprimerPatient";
    let data = {'idPatient' : idPatient};

    const req = new AjaxRequest(ajaxUrl, 'POST', data, false);
    req.send(
        (response) => {
            if(response) {
                document.getElementById('infobox').innerText = 'Suppression réussie';
                setTimeout(() => {
                    window.location.href = './praticien?patients';
                }, 2000);
            } else {
                document.getElementById('infobox').innerText = 'Une erreur est survenue';
                setTimeout(() => {
                    window.location.href = './praticien?patients';
                }, 2000);
            }
             
        }
    )
}

function getInfoPatient(idPatient) {
    const ajaxUrl = "ajax?getInfoPatient";
    let data = {'idPatient' : idPatient};
    let retour = null;

    const req = new AjaxRequest(ajaxUrl, 'POST', data, false);
    req.send(
        (response) => {
            // console.log(response);
            afficherDonneesPatient(response)
        }
    )
}

function afficherDonneesPatient(data) {
    $('#nom').val(data.nom);
    $('#prenom').val(data.prenom);
    $('#dateNaiss').val(data.dateNaiss);
    $('#telephone').val(data.telephone);
    $('#email').val(data.email);
    $('#tuteur').val(data.tuteurEmail);
    $('#numero').val(data.adresse.numero);
    $('#rue').val(data.adresse.rue);
    $('#ville').val(data.adresse.ville);
    $('#codePostal').val(data.adresse.codePostal);
    $('#pays').val(data.adresse.pays);
}

function modifierPatient(idPatient, formValues) {
    const data = {"idPatient" : idPatient, "formValues" : formValues};
    const ajaxUrl = "ajax?modifierPatient";
    const req = new AjaxRequest(ajaxUrl, 'POST', data, false);
    req.send(
        (response) => {
            if(response === true) {
                $('#form-error').text('');
                $('#form-success').text("Modification effectuée avec succès !");
                setTimeout(() => {
                    window.location.href = './praticien?patients';
                }, 2000);
            } else {
                $('#form-error').text(response);
            }
        }
    )
}

function getFormValues(id) {
    const inputs = document.querySelectorAll(id + ' input');
    const values = {};

    inputs.forEach(input => {
        values[input.name] = input.value;
    });

    return values;
}

function ajouterPatient(formValues) {
    const data = {"formValues" : formValues};
    const ajaxUrl = "ajax?ajouterPatient";
    const req = new AjaxRequest(ajaxUrl, 'POST', data, false);
    req.send(
        (response) => {
            console.log(response);
            if(response === "ok") {
                $('#form-error').text('');
                $('#form-success').text("Ajout effectué avec succès !");
                setTimeout(() => {
                    window.location.href = './praticien?patients';
                }, 2000);
            } else {
                $('#form-error').text(response);
            }
        }
    )
}