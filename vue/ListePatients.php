<?php
/**
 * VUE : Agenda.php
 */
?>

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Vos patients</h1>
    </div>

    <button id="btnAjouterPatient" data-bs-toggle="modal" data-bs-target="#formAjoutModal" class="btn btn-sm btn-primary">Ajouter un patient</button>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listePatient as $v) { ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($v['nom']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['prenom']); ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($v['dateNaiss'])); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['telephone']); ?></td>
                        <td class="text-center"><?= htmlspecialchars($v['email']); ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger btn-delete btnSupprimer" title="Supprimer le patient" info-patientId="<?= htmlspecialchars($v['id']); ?>" info-patientName="<?= htmlspecialchars($v['nom']). " " .htmlspecialchars($v['prenom']) ?>"> 
                                <i class="bi bi-trash"></i> 
                            </button>
                            <button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-sm btn-secondary btn-modif btnModifier" title="Modifier le patient" info-patientId="<?= htmlspecialchars($v['id']); ?>" info-patientName="<?= htmlspecialchars($v['nom']). " " .htmlspecialchars($v['prenom']) ?>"> 
                                <i class="bi bi-pencil"></i> 
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <div class="spacer"></div>
    </div>

</div>

<!-- modale de confirmation de suppression d'un patient -->
<div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Suppression d'un patient</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous supprimer <span id="patientName"></span> de vos patients ?
      </div>
      <span id="infobox" class="text-center" style="color: red;"></span>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modalBtnClose" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-danger" id="modalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>

<!-- modale formulaire de modification d'un patient -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Modifier la fiche patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      
      <div class="modal-body">
        <!-- <form id="patientForm"> -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="dateNaiss" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="dateNaiss" name="dateNaiss" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="tuteur" class="form-label">Tuteur (email)</label>
                <input type="email" name="tuteur" class="form-control" id="tuteur">
            </div>

        <!-- Champs adresse -->
            <div class="mb-3">
                <label for="numero" class="form-label">Numéro</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="rue" class="form-label">Voie / Rue</label>
                <input type="text" class="form-control" id="rue" name="rue" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="mb-3">
                <label for="codePostal" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" required>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" required>
            </div>
        <!-- </form> -->
      </div>

      <div class="text-center" id="form-error" style="color: red; font-weight:bold; margin : 1rem"></div>
      <div class="text-center" id="form-success" style="color: green; font-weight:bold; margin : 1rem"></div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" id="modifPatient" class="btn btn-success">Valider</button>
      </div>
      
    </div>
  </div>
</div>

<!-- modale formulaire d'ajout d'un patient -->
<div class="modal fade" id="formAjoutModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Ajouter un patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      
      <div class="modal-body">
        <!-- <form id="patientForm"> -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="dateNaiss" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="dateNaiss" name="dateNaiss" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="tuteur" class="form-label">Tuteur (email)</label>
                <input type="email" name="tuteur" class="form-control" id="tuteur">
            </div>

        <!-- Champs adresse -->
            <div class="mb-3">
                <label for="numero" class="form-label">Numéro</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="rue" class="form-label">Voie / Rue</label>
                <input type="text" class="form-control" id="rue" name="rue" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="mb-3">
                <label for="codePostal" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="codePostal" name="codePostal" required>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" required>
            </div>
        <!-- </form> -->
      </div>

      <div class="text-center" id="form-error" style="color: red; font-weight:bold; margin : 1rem"></div>
      <div class="text-center" id="form-success" style="color: green; font-weight:bold; margin : 1rem"></div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" id="ajouterPatient" class="btn btn-success">Valider</button>
      </div>
      
    </div>
  </div>
</div>