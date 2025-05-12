<?php
/**
 * VUE : Agenda.php
 */
?>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Bienvenue <?= htmlspecialchars($prenom) ?> <?= htmlspecialchars($nom) ?> !</h1>
        <h2 class="text-secondary">Mon activité : <?= htmlspecialchars($activite) ?></h2>
        <h4 class="text-muted"><?= htmlspecialchars($dateDuJour); ?></h4>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>Statut</th>
                    <th>Heure du RDV</th>
                    <th>Patient</th>
                    <th>Prestation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $v) { ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($v['libelleStatutRdv']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['heureRdv']); ?></td>
                        <td><?= htmlspecialchars($v['nomPatient']); ?> <?= htmlspecialchars($v['prenomPatient']); ?></td>
                        <td><?= htmlspecialchars($v['libellePrestation']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>