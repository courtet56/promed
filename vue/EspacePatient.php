<?php

/**
 * VUE : EspacePatient.php
 */

?>
<button type="button" class="btn btn-danger bouton-fixe" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
<div style="width: 100%; display: flex; flex-direction:column; align-items:center; justify-content:center">

	<div class="spacer"></div>
  <h1>Bonjour <?=$user['prenom']?> ! </h1>

	<div class="text-center" style="width: 80%;">

		<h1>Vos rendez-vous en cours</h1>

		<div style="margin:auto; width:100%">
			
        <table class="table table-striped rdvList" style="width: 100%;">
            <tbody>
                <?=$currentRdv?>
            </tbody>
        </table>
				
			  
		</div>

		<div class="spacer"></div>

	</div>

    <div class="text-center" style="width: 80%;">

		<h1>Vos rendez-vous annulés</h1>

		<div style="margin:auto; width:100%">
			
        <table class="table table-striped rdvList" style="width: 100%;">
                <?=$cancelRdv?>
        </table>
				
			  
		</div>

		<div class="spacer"></div>

	</div>

    <div class="text-center" style="width: 80%;">

		<h1>Vos rendez-vous passés</h1>

		<div style="margin:auto; width:100%">
			
        <table class="table table-striped rdvList" style="width: 100%;">
            <?=$oldRdv?>
        </table>
				
			  
		</div>

		<div class="spacer"></div>

	</div>

</div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="spacer"></div>

<div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Annulation d'un rendez-vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment annuler le rendez-vous du <span id="date"></span> à <span id="heure"></span> avec <span id="praticien"></span> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modalBtnClose" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-danger" id="modalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Déconnexion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez vous vraiment vous déconnecter ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="logoutModalBtnClose" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="logoutModalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>