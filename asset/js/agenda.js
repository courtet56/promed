document.addEventListener('DOMContentLoaded', function () {

    // Supprimer Rendez-Vous

    $('.btnSupprimer').on('click', function () {
        const $btn = $(this);
        const $tr = $btn.closest('tr');
        const idRdv = $tr.attr('id');

        console.log($tr.attr('id'));
        if (!confirm("Confirmer l'annulation du rendez-vous ?")) return;

        $btn.prop('disabled', true);
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
    })
});
// Fin supprimer Rdv.

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