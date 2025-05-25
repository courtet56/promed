<?php   
/*
 * VUE : ModifParamPraticien.php
 * 
 */
?>
<button type="button" class="btn btn-danger bouton-fixe" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
<div class="container">
        <h1>Mon profil</h1>
        
        <div class="row g-4">
            <!-- Colonne de gauche : Informations du profil -->
            <div class="col-lg-7">
                <div class="profile-card">
                    <h3>Informations personnelles</h3>      

                    <div class="alert alert-danger mt-3" role="alert" id="form-errors" style="display:none"></div>
                    <div class="alert alert-success mt-3" role="alert" id="form-success" style="display:none"></div>
                    <div class="alert alert-info mt-3" role="alert" id="form-info" style="display:none"></div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value="<?= $dataPrat['nom'] ?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value="<?= $dataPrat['prenom'] ?>">
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
                    
                    <h3 class="mt-4">Sécurité</h3>
                    
                    <div class="mb-3">
                        <input type="password" name="ancienMotDePasse" id="ancienMotDePasse" class="form-control" placeholder="Ancien mot de passe">
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" name="nouveauMotDePasse" id="nouveauMotDePasse" class="form-control" placeholder="Nouveau mot de passe">
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" id="btnModifier" class="btn-validate">MODIFIER</button>
                    </div>
                </div>
            </div>
            
            <!-- Colonne de droite : Prises en charge -->
            <div class="col-lg-5">
                <div class="profile-card">
                    <h3>Mes prises en charge</h3>

                    
                    <div class="mb-3">
                        <input type="hidden" name='userId' value="<?=$praticien->getId()?>" id="userId">
                    <select id="libellePrestation" class="form-select">
                        <option value=""  selected>Sélectionner la prestation</option>
                        <?php foreach ($dataLibellePrestations as $dataLibellePrestation){ ?>
                            <option value="<?= $dataLibellePrestation->getId() ?>" ><?= $dataLibellePrestation->getLibelle() ?></option>
                        <?php } ?>
                            
                        </select>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="number" id="dureeConsultation" class="form-control" value="" placeholder="Durée">
                        </div>
                        <div class="col-6">
                            <span class="min-euro-label">Minutes</span>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="number" id="prixConsultation" class="form-control" value="" placeholder="Tarif">
                        </div>
                        <div class="col-6">
                            <span class="min-euro-label">Euros</span>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="button" id="btnAjouterModifierPrestation" class="btn-validate">Ajouter/Modifier</button>
                    </div>
                    
                    <div class="mt-4">
                        <table class="table table-bordered" id="tableConsultations">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Durée</th>
                                    <th>Prix</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (!empty($dataPrestations))
                                {
                                    foreach ($dataPrestations as $dataPrestation) { ?>
                                        <tr id="<?= $dataPrestation['idPresta'] ?>">
                                            <td><?= $dataPrestation['libelle'] ?></td>
                                            <td><?=$dataPrestation['duree'] ?></td>
                                            <td><?= $dataPrestation['tarif'] ?></td>

                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger btn-delete btnSupprimer"> 
                                                    <i class="bi bi-trash"></i> 
                                                </button>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="4">Aucune consultation configurée</td>
                                    </tr>
                                <?php } ?>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>

    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Déconnexion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment vous déconnecter ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="logoutModalBtnClose" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="logoutModalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>