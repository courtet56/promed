<?php   
/*
 * VUE : InscriptionPraticien.php
 * 
 */
?>
<div class="container">
        
        
        <h1>Inscription</h1>
        
        <div class="alert alert-danger mt-3" role="alert" id="form-errors" style="display:none"></div>
        
        <form method="POST" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value="<?= isset($nom) ? $nom : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value="<?= isset($prenom) ? $prenom : '' ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <input type="text" name="activite" id="activite" class="form-control" placeholder="Activité" value="<?= isset($activite) ? $activite : '' ?>">
            </div>
            
            <div class="mb-3">
                <input type="text" name="adeli" id="adeli" class="form-control" placeholder="N°Adeli" value="<?= isset($adeli) ? $adeli : '' ?>">
            </div>
            
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Adresse email" value="<?= isset($email) ? $email : '' ?>">
            </div>
            
            <div class="row mb-3">
                <div class="col-4">
                    <input type="text" name="numero" id="numero" class="form-control" placeholder="N°" value="<?= isset($numero) ? $numero : '' ?>">
                </div>
                <div class="col-8">
                    <input type="text" name="rue" id="rue" class="form-control" placeholder="Voie" value="<?= isset($rue) ? $rue : '' ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="ville" id="ville" class="form-control" placeholder="Ville" value="<?= isset($ville) ? $ville : '' ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="codePostal" id="codePostal" class="form-control" placeholder="Code postal" value="<?= isset($codePostal) ? $codePostal : '' ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <input type="text" name="pays" id="pays" class="form-control" placeholder="Pays" value="<?= isset($pays) ? $pays : '' ?>">
            </div>
            
            <div class="mb-3">
                <input type="password" name="motDePasse" id="motDePasse" class="form-control" placeholder="Mot de passe" value="<?= isset($motDePasse) ? $motDePasse : '' ?>">
            </div>
            
            <div class="mb-3">
                <input type="password" name="motDePasse2" id="motDePasse2" class="form-control" placeholder="Confirmer le mot de passe" value="<?= isset($motDePasse2) ? $motDePasse2 : '' ?>">
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-5">
                    <img src="<?= $actual_link ?>captcha" alt="captcha" class="img-fluid captcha-image">
                </div>
                <div class="col-7">
                    <input type="text" name="captcha" id="captcha" class="form-control" placeholder="CAPTCHA" required>
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" id="btnInscription" class="btn btn-validate">Valider</button>
            </div>
        </form>
    </div>
</div>
                