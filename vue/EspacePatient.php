<?php

/**
 * VUE : EspacePatient.php
 */

?>
<button type="button" class="btn btn-danger bouton-fixe" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
<div style="width: 100%; display: flex; flex-direction:column; align-items:center; justify-content:center">

	<div class="spacer"></div>
  <h1>Bonjour <?=$user['prenom']?> ! </h1>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">En cours</button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Annulés</button>
      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Passés</button>
      </div>
  </nav>

<div class="text-center tab-content" style="width: 80%;">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
		<h1>Vos rendez-vous en cours</h1>

      <div class="d-none d-md-block" style="margin:auto; width:100%">
        <?php
        if(is_array($currentRdv) && !empty($currentRdv)) {
        ?>
        <!-- affichage grand ecran -->
        <table class="table table-striped rdvList table-responsive" style="width: 100%;">
            <thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                <th scope='col'></th>
                </tr>
            </thead><tbody>
            <?php
              foreach($currentRdv as $curRdv) {
            ?>
            <tr><td><?=DateTime::createFromFormat('Y-m-d', $curRdv["dateRdv"])->format('d/m/Y')?></td>
            <td><?=DateTime::createFromFormat('H:i:s', $curRdv["heureRdv"])->format('H:i')?></td>
            <td><?=$curRdv["praticien"]?></td>
            <td><?=$curRdv['presta']?></td>
            <td><button type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='<?=$curRdv['id']?>'>Annuler</button></td>
            <?php      
              }
            ?>
          </tbody>
        </table>
        <?php
          } else {
        ?>
          <p>Vous n'avez pas de rendez-vous prévus pour le moment.</p>
        <?php
          }
        ?>
      </div>
      <!-- affichage mobile -->
  <div class="accordion d-md-none" id="accordeonEnCours" style="width: 100%;">

  <?php
  if(is_array($currentRdv) && !empty($currentRdv)) {
   foreach ($currentRdv as $index => $rdv): ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading<?=$index?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$index?>" aria-expanded="false" aria-controls="collapse<?=$index?>">
          Rendez-vous du <?=DateTime::createFromFormat('Y-m-d', $rdv["dateRdv"])->format('d/m/Y')?> à <?=DateTime::createFromFormat('H:i:s', $rdv["heureRdv"])->format('H:i')?>
        </button>
      </h2>
      <div id="collapse<?=$index?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$index?>" data-bs-parent="#accordeonEnCours">
        <div class="accordion-body">
          <p><strong>Praticien :</strong> <?=$rdv['praticien']?></p>
          <p><strong>Motif :</strong> <?=$rdv['presta']?></p>
          <p><strong>Statut :</strong> <?=$rdv['libelle']?></p>
          <button type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='<?=$rdv['id']?>'>Annuler</button>
        </div>
      </div>
    </div>
  <?php endforeach; 
  }
  else {?>
<p>Vous n'avez pas de rendez-vous prévus pour le moment.</p>
<?php
  }
?>
</div>
		<div class="spacer"></div>
  </div>
</div>

    <div class="text-center tab-content" style="width: 80%;">
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

		<h1>Vos rendez-vous annulés</h1>

<!-- affichage grand écran -->
<div class="d-none d-md-block" style="margin:auto; width:100%">
<?php
 if(is_array($cancelRdv) && !empty($cancelRdv)) {
 ?>
  <table class="table table-striped rdvList table-responsive" style="width: 100%;">
  <thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                <th scope='col'></th>
                </tr>
            </thead><tbody>
    <?php
    foreach($cancelRdv as $curRdv) {
    ?>
    <tr><td><?=DateTime::createFromFormat('Y-m-d', $curRdv["dateRdv"])->format('d/m/Y')?></td>
    <td><?=DateTime::createFromFormat('H:i:s', $curRdv["heureRdv"])->format('H:i')?></td>
    <td><?=$curRdv["praticien"]?></td>
    <td><?=$curRdv['presta']?></td>
    <td><button disabled type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='<?=$curRdv['id']?>'>Annulé</button></td>
    <?php      
    }
    ?>
  </tbody></table>
  <?php
 } else {
  ?>
  <p>Vous n'avez pas de rendez-vous annulés pour le moment.</p>
  <?php
   }
   ?>
</div>

<!-- accordeon pour affichage mobile -->
<div class="accordion d-md-none" id="accordeonAnnules" style="width: 100%;">

  <?php
  if(is_array($cancelRdv) && !empty($cancelRdv)) {
   foreach ($cancelRdv as $index => $rdv): ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading<?=$index?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$index?>" aria-expanded="false" aria-controls="collapse<?=$index?>">
          Rendez-vous du <?=DateTime::createFromFormat('Y-m-d', $rdv["dateRdv"])->format('d/m/Y')?> à <?=DateTime::createFromFormat('H:i:s', $rdv["heureRdv"])->format('H:i')?>
        </button>
      </h2>
      <div id="collapse<?=$index?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$index?>" data-bs-parent="#accordeonAnnules">
        <div class="accordion-body">
          <p><strong>Praticien :</strong> <?=$rdv['praticien']?></p>
          <p><strong>Motif :</strong> <?=$rdv['presta']?></p>
          <p><strong>Statut :</strong> <?=$rdv['libelle']?></p>
        </div>
      </div>
    </div>
  <?php endforeach; 
  }
  else {?>
<p>Vous n'avez pas de rendez-vous annulés pour le moment.</p>
<?php
  }
?>
</div>

<div class="spacer"></div>

    </div>
	</div>

    <div class="text-center tab-content" style="width: 80%;">
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">

		<h1>Vos rendez-vous passés</h1>

		<div class="d-none d-md-block" style="margin:auto; width:100%">
        <?php
        if(is_array($oldRdv) && !empty($oldRdv)) {
        ?>
        <!-- affichage grand ecran -->
        <table class="table table-striped rdvList table-responsive" style="width: 100%;">
            <thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                </tr>
            </thead><tbody>
            <?php
              foreach($oldRdv as $curRdv) {
            ?>
            <tr><td><?=DateTime::createFromFormat('Y-m-d', $curRdv["dateRdv"])->format('d/m/Y')?></td>
            <td><?=DateTime::createFromFormat('H:i:s', $curRdv["heureRdv"])->format('H:i')?></td>
            <td><?=$curRdv["praticien"]?></td>
            <td><?=$curRdv['presta']?></td>
            <?php      
              }
            ?>
          </tbody>
        </table>
        <?php
          } else {
        ?>
          <p>Vous n'avez pas de rendez-vous passés pour le moment.</p>
        <?php
          }
        ?>
      </div>
      <div class="accordion d-md-none" id="accordeonPasses" style="width: 100%;">

      <?php
      if(is_array($oldRdv) && !empty($oldRdv)) {
      foreach ($oldRdv as $index => $rdv): ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading<?=$index?>">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$index?>" aria-expanded="false" aria-controls="collapse<?=$index?>">
              Rendez-vous du <?=DateTime::createFromFormat('Y-m-d', $rdv['dateRdv'])->format('d/m/Y')?> à <?=DateTime::createFromFormat('H:i:s', $rdv["heureRdv"])->format('H:i')?>
            </button>
          </h2>
          <div id="collapse<?=$index?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$index?>" data-bs-parent="#accordeonPasses">
            <div class="accordion-body">
              <p><strong>Praticien :</strong> <?=$rdv['praticien']?></p>
              <p><strong>Motif :</strong> <?=$rdv['presta']?></p>
              <p><strong>Statut :</strong> <?=$rdv['libelle']?></p>
            </div>
          </div>
        </div>
      <?php endforeach; 
      }
      else {?>
    <p>Vous n'avez pas de rendez-vous passés pour le moment.</p>
    <?php
      }
    ?>
    </div>

		<div class="spacer"></div>

	</div>
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
        Voulez-vous vraiment annuler ce rendez-vous ?
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
        Voulez-vous vraiment vous déconnecter ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="logoutModalBtnClose" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="logoutModalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>