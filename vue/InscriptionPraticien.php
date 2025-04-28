<?php   
/*
 * VUE : InscriptionPraticien.php
 * 
 */
?>
<div class="container">
    <div class="spacer"></div>
    <div class="text-center">
        <h1>Inscription praticien</h1>
        <div style="margin:auto; width:50%">
            <form method="POST" action="">
                <div class="d-flex justify-content-center">
                    <label for="nom">Nom : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value="<?= isset($nom) ? $nom : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="prenom">Prénom : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value="<?= isset($prenom) ? $prenom : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="activite">Activité : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="activite" id="activite" class="form-control" placeholder="Activité" value="<?= isset($activite) ? $activite : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="numero">Numéro : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="numero" id="numero" class="form-control" placeholder="Numéro" value="<?= isset($numero) ? $numero : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="rue">Rue : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="rue" id="rue" class="form-control" placeholder="Rue" value="<?= isset($rue) ? $rue : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="codePostal">Code postal : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="codePostal" id="codePostal" class="form-control" placeholder="Code postal" value="<?= isset($codePostal) ? $codePostal : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="ville">Ville : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="ville" id="ville" class="form-control" placeholder="Ville" value="<?= isset($ville) ? $ville : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="pays">Pays : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="pays" id="pays" class="form-control" placeholder="Pays" value="<?= isset($pays) ? $pays : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="email">E-mail : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?= isset($email) ? $email : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="adeli">Numéro Adeli : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text" name="adeli" id="adeli" class="form-control" placeholder="Numéro Adeli" value="<?= isset($adeli) ? $adeli : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="motDePasse">Mot de passe : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="Mot de passe" value="<?= isset($motDePasse) ? $motDePasse : '' ?>">
                </div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <label for="motDePasse2">Confirmer mot de passe : </label>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="password" name="motDePasse2" id="motDePasse2" class="form-control" placeholder="Confirmer mot de passe" value="<?= isset($motDePasse2) ? $motDePasse2 : '' ?>">
                </div>
                <div class="spacer"></div>
                <label for="captcha">Recopiez le texte de l'image :</label><br>
                    <img src="<?= $actual_link ?>captcha" alt="captcha"><br>
                    <input type="text" name="captcha" required>
                <div class="spacer"></div>
                <button type='submit' id='btnInscription' class="btn btn-primary">Inscription</button>
            </form>
            <div class="spacer"></div>
        </div>
    </div>
</div>

                