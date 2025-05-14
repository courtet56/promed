document.addEventListener('DOMContentLoaded', function () {
    $('#btnAjouter').on('click', function() {
        const form = $('#formulaireRdv form');
        const messageError = $('#userMessageError');
        const messageSuccess = $('#userMessageSuccess');
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
    $('#fermerFormulaire').on('click', function () {
        const form = $('#formulaireRdv form');
        if (form.attr('hidden')) {
            form.removeAttr('hidden'); // Affiche
        } else {
            form.attr('hidden', true); // Cache
        }

    })

});

// function getFormData() {
//     const fieldNames = [
//         'selectPatient', 'selectPrestation', 'dateRdv', 'heureRdv'
//     ];

//     formDataAjoutRdv = {};
//     for (let i = 0; i < fieldNames.length; i++) {
//         const field = fieldNames[i];
//         const element = document.getElementById(field);

//         if (element) {
//             formDataPresta[field] = element.value.trim();
//         }
//     }
//     return formDataAjoutRdv;

// }

// document.addEventListener('DOMContentLoaded', function () {
//     const champPatient = $('#selectPatient');
//     const champPresta = $('#selectPrestation');
//     const champDateRdv = $('#dateRdv');
//     const champHeureRdv = $('#heureRdv');
//     $('.btn-confirmer').on('click', function() {
//         const ajaxUrl = ?;
//         const formData = getFormData();
//     } )

// })
