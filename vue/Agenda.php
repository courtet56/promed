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
    <div class="btn-actions-container">
        <a href="<?= htmlspecialchars($ajouterRdvUrl) ?>" class="btn-ajouter-rdv">
            + Ajouter un Rendez-vous
        </a>
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