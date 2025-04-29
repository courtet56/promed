<?php
/**
 * VUE : AuthentifPatient.php
 */

?>


<div class="container">

	<div class="spacer"></div>

	<div class="text-center">

		<h1>Bienvenue sur ProMed</h1>

		<div style="margin:auto; width:50%">
			<form method="POST" action="auth/validation">
					
					<div class="alert alert-danger mt-3" role="alert" id="form-errors" style="display:none"></div>

					<div class="radioDiv">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="choixUtilisateur" id="praticien">
							<label class="form-check-label" for="praticien">
								Praticien
							</label>
						</div>

						<div class="form-check">
							<input class="form-check-input" type="radio" name="choixUtilisateur" id="patient" checked>
							<label class="form-check-label" for="patient">
								Patient
							</label>
						</div>
					</div>

					<div class="d-flex justify-content-center">
						<input type="text" name="email" id="email" class="form-control" placeholder="email">
					</div>
					<div class="spacer"></div>
					<div class="d-flex justify-content-center">
						<input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="mot de passe">
					</div>
					<div class="spacer"></div>
					<label for="captcha" class="col-form-label-lg">Recopiez le texte de l'image :</label><br>
    				<img src="<?= $actual_link ?>captcha" alt="captcha"><br>
    				<div class="spacer"></div>
					<input type="text" name="captcha" id="captcha" class="form-control" placeholder="CAPTCHA" required>
					<div class="spacer"></div>
					<div class="d-flex justify-content-center">
						<button type="submit" id="btnAuthentif" class="btn btn-primary">Valider</button> 
					</div>

			</form>
			  
		</div>

		<div class="spacer"></div>

	</div>

</div>