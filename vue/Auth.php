<?php

/**
 * VUE : AuthentifPatient.php
 */

?>
<div class="container">

	<div class="spacer"></div>

	<div class="text-center">

		<h1>Connexion</h1>

		<div style="margin:auto; width:50%">
			

				<form method="POST" action="">
					<div class="radioDiv">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
							<label class="form-check-label" for="radioDefault1">
								Praticien
							</label>
						</div>

						<div class="form-check">
							<input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
							<label class="form-check-label" for="radioDefault2">
								Patient
							</label>
						</div>
					</div>
					
					<div class="mb-3">
						<input type="email" class="form-control" id="loginInput" placeholder="Identifiant">
					</div>
					<div class="spacer"></div>
					<div class="d-flex justify-content-center">
						<input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="Mot de passe">
					</div>
					<div class="spacer"></div>
					<button class="btn" id="loginButton" style="margin: 20px 0 0 0;">Valider</button>
				</form>
			  
		</div>

		<div class="spacer"></div>

	</div>

</div>