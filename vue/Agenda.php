<?php
/**
 * VUE : Agenda.php
 */
?>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Bienvenue <?= $praticien->getPrenom() ?> <?= $praticien->getNom() ?> !</h1>
        <h2 class="text-secondary">Mon activité : <?= $praticien->getActivite() ?></h2>
        <h4 class="text-muted"><?= htmlspecialchars($dateDuJour); ?></h4>
    </div>
    <input type="button" class="btn-ajouter-rdv" id="btnAjouter" value="+ Ajouter un Rendez-vous">

    <div class="btn-actions-container">
        <?php if (!empty($_SESSION['messageSuccess'])): ?>
        <div id="userMessageSuccess" class="alert alert-success">
            <?= htmlspecialchars($_SESSION['messageSuccess']) ?>
        </div>
        <?php unset($_SESSION['messageSuccess']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['messageError'])): ?>
        <div id="userMessageError" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['messageError']) ?>
        </div>
        <?php unset($_SESSION['messageError']); ?>
        <?php endif; ?>
        <div id="formulaireRdv" class="formulaire-rdv" >
            <form action="" method="post" class="form-rdv" hidden>
                
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
                    <button type="button" class="btn-fermer" id="fermerFormulaire">Fermer</button>
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