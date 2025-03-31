<?php

/**
 * VUE : AuthentifPatient.php
 */

?>
<div class="container">

	<div class="spacer"></div>

	<div class="text-center">

		<h1>Bienvenue sur ProMed</h1>

		<div class="avatar">
			<div class="load-bloc spinner-border spinner-border" style="display:none" role="status"></div>
			<img id="avatar" class="img-thumbnail" src="<?= $actual_link ?>asset/img/logo-promed.jpg" />
		</div>

		<div style="margin:auto; width:50%">
			
			  <p>
				<form method="POST" action="">
				  <div class="d-flex justify-content-center">
					<input type="text" name="email" class="form-control" placeholder="Tester POST sur le contrôleur About">
					<button class="btn btn-primary">Tester</button>
				  </div>
				</form>
			  </p>
			  
			</div>

		<p><?php include(AJAX_DIR . 'ajaxRechercher.php'); ?></p>

		<div style="margin:auto; display:inline-block;">
			<div style="text-align:left">
				<p>Liste des utilisteurs (table <b><?= $table ?></b>) :</p>
				<?php
				foreach ($allData as $k => $v) {
					echo '<li><small>[id n°' . $v->idPatient . ']</small> ' . $v->prenom . ' ' . $v->nom . '</li>';
				}
				?>
			</div>
		</div>

		<div class="spacer"></div>

		<p>Le tableau param affiche :</p>
		<?php
		foreach ($param as $k => $v) {
			echo $k . ' = ' . $v . '<br />';
		}
		?>

	</div>

</div>