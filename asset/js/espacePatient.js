document.addEventListener('DOMContentLoaded', function() {
    logoutButton = document.getElementById('logoutButton');
    if(logoutButton) {
        logoutButton.addEventListener('click', function() {
            $('#logoutModalBtnConfirm').on('click', function() { // si bouton de confirmation de la modale est cliqué
                deconnexion();
            });
    
            $('#logoutModalBtnClose').on('click', function() { // fermeture de la modale si annulation avortée (bouton "fermer" cliqué)
                console.log("annulation"); // debug
            });
        })
    }
})


document.addEventListener('DOMContentLoaded', function() {
    $('.cancelBtn').on('click', function() {
        const idRdv = $(this).attr('idrdv');

        const $tr = $(this).closest('.accordion-item');
        const $tds = $tr.find('td');
        // récupération de la date, de l'heure et du nom du praticien correspondant au rdv
        const date = $tds.eq(0).text().trim();
        const heure = $tds.eq(1).text().trim();
        const nom = $tds.eq(2).text().trim();
        // affichage des données du rdv dans la modale pour récap à l'utilisateur
        $('#date').text(date);
        $('#heure').text(heure);
        $('#praticien').text(nom);

        $('#modalBtnConfirm').on('click', function() { // si bouton de confirmation de la modale est cliqué
            supprimerRendezVous(idRdv);
            console.log("annulation confirmée");
        });

        $('#modalBtnClose').on('click', function() { // fermeture de la modale si annulation avortée (bouton "fermer" cliqué)
            console.log("modale fermée"); // debug
        });
    });
});

function supprimerRendezVous(idRdv) {
    const ajaxUrl = 'ajax?annulerRdv';

    const request = new AjaxRequest(
        ajaxUrl,
        'POST',
        {'idRdv' : idRdv}
    );

    request.send(
        (response) => {
            switch (response) {
                case true : 
                window.location.href = '';
                exit;
                case false :
                window.location.href = '';
                exit;
            }
            console.log(response);
        })
}

function deconnexion() {
    const ajaxUrl = 'ajax?logout';

    
    const request = new AjaxRequest(
        ajaxUrl,
        'POST',
        {'logout' : true}
    )

    request.send(
        (response) => {
            console.log(response);
            window.location.href = './accueil'
        }
    )
}