document.addEventListener('DOMContentLoaded', function () {

    // Supprimer Rendez-Vous

    $('.btnSupprimer').on('click', function () {
        const $btnSupprimer = $(this);
        const $tr = $btnSupprimer.closest('tr');
        const idRdv = $tr.attr('id');

        console.log($tr.attr('id'));
        if (!confirm("Confirmer l'annulation du rendez-vous ?")) return;

        $btnSupprimer.prop('disabled', true);
        let data = { 'idRdv': idRdv };
        const ajaxUrl = 'ajax?annulerRdv';
        const request = new AjaxRequest(ajaxUrl, 'POST', data, true);
        request.send(
            (response) => {
                console.log("Réponse AJAX :", response);

                if (response == true) {
                    // ✅ Mise à jour du badge dans la ligne
                    const $badge = $tr.find('.statut-label');

                    $badge
                        .removeClass('badge-confirmé badge-attente')
                        .addClass('badge-annulé')
                        .text('Annulé')
                        .fadeIn(200);

                    alert("Rendez-vous annulé avec succès.");
                } else {
                    alert("Erreur lors de l’annulation : " + (response?.message || 'Réponse invalide'));
                }
            }
        )
    });

    $('.btnModifier').on('click', function () {
        const $btn = $(this);
        const $tr = $btn.closest('tr');
        const idRdv = $tr.attr('id');

        // Lecture des champs actuels depuis la ligne
        const dateRdv = $tr.find('td:eq(1)').text().trim();
        const heureRdv = $tr.find('td:eq(2)').text().trim();

        // Préremplir les champs de la modale
        $('#rdvId').val(idRdv);
        $('#dateRdv').val(dateRdv);
        $('#heureRdv').val(heureRdv);

        // Afficher la modale
        const modal = new bootstrap.Modal(document.getElementById('modalModifierRdv'));
        modal.show();
    });

    $('#formModifierRdv').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize(); // récupère tous les champs

        const request = new AjaxRequest('ajax?validerModificationRdv', 'POST', formData, true);
        request.send((response) => {
            console.log("Réponse AJAX :", response);
            if (response == true) {
                alert("Rendez-vous modifié avec succès !");
                location.reload(); // Ou mise à jour dynamique du tableau
            } else {
                alert("Erreur : " + (response?.message || 'Réponse invalide'));
            }
        });
    });

});

//Début Traitement Ajout Rendez-vous:
document.addEventListener('DOMContentLoaded', function () {
    $('#btnAjouterRdv').on('click', function() {
        const form = $('#formulaireRdv');
        const messageError = $('#userMessageErrorRdv');
        const messageSuccess = $('#userMessageSuccessRdv');
        if (form.attr('hidden')) {
            form.removeAttr('hidden'); // Affiche
        } else {
            form.attr('hidden', true); // Cache
        }
        if(messageError.text() !== ''){
            messageError.remove();
        }
        if(messageSuccess.text() !== ''){
            messageSuccess.remove();
        }
        })
    $('#fermerFormulaireRdv').on('click', function () {
        const form = $('#formulaireRdv');
        if (form.attr('hidden')) {
            form.removeAttr('hidden'); // Affiche
        } else {
            form.attr('hidden', true); // Cache
        }

    })
});