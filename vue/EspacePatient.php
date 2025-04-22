<?php

/**
 * VUE : EspacePatient.php
 */

?>
<div style="width: 100%; display: flex; flex-direction:column; align-items:center; justify-content:center">

	<div class="spacer"></div>

	<div class="text-center" style="width: 80%;">

		<h1>Vos rendez-vous</h1>

		<div style="margin:auto; width:100%">
			
        <table class="table table-striped rdvList" style="width: 100%;">
            <thead>
                <tr>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Praticien</th>
                <th scope="col">Prise en charge</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?=$tableRdv?>
            </tbody>
        </table>
				
			  
		</div>

		<div class="spacer"></div>

	</div>

</div>