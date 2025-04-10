<?php

namespace Controleur;

use modele\DAO\PraticienDAO as Model;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;

Class AuthentifPraticien
{
	public function __construct() {
    
		/**
		 *	--------------
		 *	    MODELE
		 *	--------------
		 */

		/**
		 *	MODELE : Instance de PraticienDAO
		 */
		$db = new Model();

        $email = trim(req::post('email'));
        $motDePasse = trim(req::post('motDePasse'));

        if (empty($email) || empty($motDePasse)) {
            // TODO retourner message d'erreur
            var_dump("Champ vide");
        } else {

            $praticien = $db->getPraticienByEmail($email);

            if (isset($praticien) && password_verify($motDePasse, $praticien['motDePasse'])) {
                // TODO se connecter à l'espace Praticien
                 // Connexion réussie
        $_SESSION['IdPraticien'] = $praticien['idPraticien'];
        $_SESSION['nom'] = $praticien['nom'];
        $_SESSION['prenom'] = $praticien['prenom'];
        header('Location: espace_praticien.php');
        
                // TODO mettre en place la session Praticien
                var_dump("Connexion OK");
            } else {
                // TODO retourner message d'erreur : identifiant ou mot de passe invalide
                var_dump("Champ invalide");
            }

        }
    }
		
}