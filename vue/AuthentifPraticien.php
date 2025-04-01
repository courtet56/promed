<?php

/**
 * VUE : AuthentifPraticien.php
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

		<h2>Espace praticien</h2>

		<div style="margin:auto; width:50%">
			

				<form method="POST" action="">
					<div class="d-flex justify-content-center">
						<label for="email">E-mail : </label>
					</div>
					<div class="d-flex justify-content-center">
						<input type="text" name="email" id="email" class="form-control" placeholder="login">
					</div>
					<div class="spacer"></div>
					<div class="d-flex justify-content-center">
						<label for="motDePasse">Mot de passe : </label>
					</div>
					<div class="d-flex justify-content-center">
						<input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="mot de passe">
					</div>
					<div class="spacer"></div>
					<button class="btn btn-primary">Tester</button>
				</form>
			  
		</div>

		<div class="spacer"></div>

	</div>

</div>