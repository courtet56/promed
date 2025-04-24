<?php


?>


<div class="container">

    <div class="spacer"></div>

    <!-- <div class="text-center"> -->
    <div>

        <h1 class="text-center">Nouvelle fiche patient</h1>


        <div class="spacer"></div>

        <div style="margin:auto; width:50%">
            <form method="POST" action="validation">




                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Colonne de gauche</h3>
                            <p>Contenu à gauche, prend 4 colonnes sur 12.</p>
                        </div>
                        <div class="col-md-4">





                            <div class="d-flex justify-content-center">
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom">
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="dateNaiss" id="dateNaiss" class="form-control"
                                    placeholder="Date de naissance">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="adresse" id="adresse" class="form-control"
                                    placeholder="Adressse">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="codePostal" id="codePostal" class="form-control"
                                    placeholder="Code Postal">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="ville" id="ville" class="form-control" placeholder="Ville">
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="telephone" id="telephone" class="form-control"
                                    placeholder="Téléphone">
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tuteur">
                                <label class="form-check-label" for="tuteur">
                                    Tuteur
                                </label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom">
                            </div>

                            <div class="d-flex justify-content-center">
                                <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom">
                            </div>


                        </div>

                        <div class="col-md-4">
                            <h3>Colonne de droite</h3>
                            <p>Contenu à droite, prend 4 colonnes sur 12.</p>
                        </div>
                    </div>

                    
                </div>


                <div class="spacer"></div>
                <label for="captcha">Recopiez le texte de l'image :</label><br>
                <img src="<?= $actual_link ?>captcha" alt="captcha"><br>
                <input type="text" name="captcha" required>
                <div class="spacer"></div>
                <button class="btn btn-primary">Valider</button>
            </form>

        </div>

        <div class="spacer"></div>

    </div>

</div>