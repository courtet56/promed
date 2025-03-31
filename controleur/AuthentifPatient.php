<?php

namespace Controleur;

use modele\DAO\PatientDAO as Model;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;

Class AuthentifPatient
{
	public function __construct() {
    
		/**
		 *	--------------
		 *	    MODELE
		 *	--------------
		 */

		/**
		 *	MODELE : Instance de PatientDAO
		 */
		$db = new Model();

        $email = trim(req::post('email'));
        $motDePasse = trim(req::post('motDePasse'));

        if (empty($email) || empty($motDePasse)) {
            // TODO retourner message d'erreur
            var_dump("Champ vide");
        } else {

            $patient = $db->getPatientByEmail($email);

            if (isset($patient) && password_verify($motDePasse, $patient['motDePasse'])) {
                // TODO se connecter à l'espace Patient
                // TODO mettre en place la session Patient
                var_dump("Connexion OK");
            } else {
                // TODO retourner message d'erreur : identifiant ou mot de passe invalide
                var_dump("Champ invalide");
            }

        }
    }
		
}