document.addEventListener('DOMContentLoaded', function() {
    logoutButton = document.getElementById('logoutButton');
    if(logoutButton) {
        logoutButton.addEventListener('click', function() {
            $('#logoutModalBtnConfirm').on('click', function() { // si bouton de confirmation de la modale est cliqué
                deconnexion();
            });
        })
    }
})

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