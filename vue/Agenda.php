<?php
/**
 * VUE : Agenda.php
 */
?>

<div class="container py-5">

    <!-- <div class="text-center mb-4">
        <h1 class="fw-bold">Bienvenue <?= $praticien->getPrenom() ?> <?= $praticien->getNom() ?> !</h1>
        <h2 class="text-secondary">Mon activité : <?= $praticien->getActivite() ?></h2>
        <h4 class="text-muted"><?= htmlspecialchars($dateDuJour); ?></h4>
    </div> -->
    <input type="button" class="btn-ajouter-rdv" id="btnAjouterRdv" value="+ Ajouter un Rendez-vous">

    <div class="btn-actions-container">
        <?php if (!empty($_SESSION['messageSuccessRdv'])): ?>
        <div id="userMessageSuccessRdv" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['messageSuccessRdv']) ?>
        </div>
        <?php unset($_SESSION['messageSuccessRdv']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['messageErrorRdv'])): ?>
        <div id="userMessageErrorRdv" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['messageErrorRdv']) ?>
        </div>
        <?php unset($_SESSION['messageErrorRdv']); ?>
        <?php endif; ?>
        <div id="formulaireRdv" class="formulaire-rdv" hidden >
            <form action="" method="post" class="form-rdv" >
                
                <div class="form-group mb-3">
                    <label for="selectPatient" class="form-label">Patient</label>
                    <select name="idPatient" id="selectPatient" class="form-select" required>
                        <option value="" disabled selected>Choisir un patient</option>
                    <?php foreach ($arraySoignes as $soigne){ ?>
                        <option value="<?= $soigne['idPatient'] ?>"><?= $soigne['nomPatient']?> - <?=$soigne['prenomPatient']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="selectPrestation" class="form-label">Prestation</label>
                    <select name="idPrestation" id="selectPrestation" class="form-select" required>
                        <option value="" disabled selected>Choisir une prestation</option>
                        <?php foreach($dataPrestations as $dataPrestation) { ?>
                            <option value="<?=$dataPrestation['idPresta']?>"> <?=$dataPrestation['libelle']?> - <?=$dataPrestation['duree']?> mins - <?=$dataPrestation['tarif']?> €</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="dateRdv" class="form-label">Date du rendez-vous</label>
                    <input type="date" class="form-control" id="dateRdv" name="dateRdv" required>
                </div>
                <div class="form-group mb-3">
                    <label for="heureRdv" class="form-label">Heure du rendez-vous</label>
                    <input type="time" class="form-control" id="heureRdv" name="heureRdv" required>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" name='btnConfirmer' value="1" class="btn-confirmer">Confirmer</button>
                    <button type="button" class="btn-fermer" id="fermerFormulaireRdv">Fermer</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>Statut</th>
                    <th>Date du Rdv</th>
                    <th>Heure du RDV</th>
                    <th>Durée (mn)</th>
                    <th>Patient</th>
                    <th>Prestation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $v) { ?>
                    <tr id="<?= $v['idRdv'] ?>">
                        <td class="text-center">
                            <span class="badge-statut statut-label <?= strtolower($v['libelleStatutRdv']) === 'confirmé' ? 'badge-confirmé' : (strtolower($v['libelleStatutRdv']) === 'annulé' ? 'badge-annulé' : 'badge-attente') ?>">
                                <?= htmlspecialchars($v['libelleStatutRdv']); ?>
                            </span>
                        </td>
                        <td class="text-center"><?= htmlspecialchars($v['dateRdv']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['heureRdv']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['dureeRdv']); ?></td>
                        <td><?= htmlspecialchars($v['nomPatient']); ?> <?= htmlspecialchars($v['prenomPatient']); ?></td>
                        <td><?= htmlspecialchars($v['libellePrestation']); ?></td>
                        <td class="text-center">
                            <?php if (strtolower($v['libelleStatutRdv']) !== 'annulé') : ?>
                                <button class="btn btn-sm btn-danger btn-delete btnSupprimer"> 
                                    <i class="bi bi-trash"></i> 
                                </button>
                                <button class="btn btn-sm btn-primary btnModifier"> 
                                    <i class="bi bi-pencil-square"></i> 
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <div class="spacer"></div>
    </div>

</div>
<div class="modal fade" id="modalModifierRdv" tabindex="-1" aria-labelledby="modalModifierRdvLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formModifierRdv">
        <div class="modal-header">
          <h5 class="modal-title" id="modalModifierRdvLabel">Modifier le rendez-vous</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="modalRdvId" name="idRdv">

          <div class="mb-3">
            <label for="dateRdv" class="form-label">Date</label>
            <input type="date" class="form-control" id="modalDateRdv" name="dateRdv" required>
          </div>
          <div class="mb-3">
            <label for="heureRdv" class="form-label">Heure</label>
            <input type="time" class="form-control" id="modalHeureRdv" name="heureRdv" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>