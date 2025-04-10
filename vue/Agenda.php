<?php

/**
 * VUE : Accueil.php
 */

?>
<div class="container">

	<div class="spacer"></div>

	<div class="text-center">

		<h1>Bienvenue <?= $prenom ?> <?= $nom ?> !</h1>
        <h2>Mon activité :  <?= $activite ?></h2>
        <h2><?= $dateDuJour; ?> </h2>


        <table>

            <thead>

             <tr>
                <th></th>
                <th>RDV</th>*
                <th>Patients</th>
                <th>Prises en charge</th>
             </tr>

            </thead>

            <tbody>

            <?php foreach ($data as $v) { ?>
                <tr>
                <td>
                    <?= $v['libelleStatutRdv']; ?>
                </td>

                <td>
                    <?= $v['heureRdv']; ?>
                </td>
                <td>
                    <?= $v['nomPatient']; ?> <?= $v['prenomPatient']; ?>
                </td>
                <td>
                    <?= $v['libellePrestation']; ?>
                </td>
                </tr>
                <?php } ?>
             </tbody>

        </table>
	
		

	</div>

</div>