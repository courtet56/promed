<?php   
/*
 * VUE : ModifParamPraticien.php
 * 
 */
?>

<div class="container">
        
   
        <h1>Mon profil</h1>
        
        <div class="alert alert-danger mt-3" role="alert" id="form-errors" style="display:none"></div>
        <div class="alert alert-success mt-3" role="alert" id="form-success" style="display:none"></div>
        <div class="alert alert-info mt-3" role="alert" id="form-info" style="display:none"></div>

        
        
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value= "<?= $dataPrat['nom'] ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value= "<?= $dataPrat['prenom'] ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <input type="text" name="activite" id="activite" class="form-control" placeholder="Activité" value="<?= $dataPrat['activite'] ?>">
            </div>
            
            <div class="mb-3">
                <input type="text" name="adeli" id="adeli" class="form-control" placeholder="N°Adeli" value="<?= $dataPrat['adeli'] ?>">
            </div>
            
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Adresse email" value="<?= $dataPrat['email'] ?>">
            </div>
            
            <div class="row mb-3">
                <div class="col-4">
                    <input type="text" name="numero" id="numero" class="form-control" placeholder="N°" value="<?= $dataPrat['numero'] ?>">
                </div>
                <div class="col-8">
                    <input type="text" name="rue" id="rue" class="form-control" placeholder="Voie" value="<?= $dataPrat['rue'] ?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="ville" id="ville" class="form-control" placeholder="Ville" value="<?= $dataPrat['ville'] ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="codePostal" id="codePostal" class="form-control" placeholder="Code postal" value="<?= $dataPrat['codePostal'] ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <input type="text" name="pays" id="pays" class="form-control" placeholder="Pays" value="<?= $dataPrat['pays'] ?>">
            </div>
            
            <div class="mb-3">
                <input type="password" name="ancienMotDePasse" id="ancienMotDePasse" class="form-control" placeholder="Ancien mot de passe" >
            </div>
            
            <div class="mb-3">
                <input type="password" name="nouveauMotDePasse" id="nouveauMotDePasse" class="form-control" placeholder="Nouveau mot de passe">
            </div>
            
            
            <div class="d-grid gap-2">
                <button type="submit" id="btnModifier" class="btn btn-validate">Modifier</button>
            </div>
    </div>
</div>          