<?php

namespace Test;

use modele\DAO\PatientDAO as Model;
use modele\Patient as Metier;
use app\util\Request as req;
use Controleur\AuthentifPatient as AuthentifPatient;

Class TestAuthentifPatient
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

        $patient = new Metier("Chivot", "Baptiste", "1995-01-19", "00 00 00 00 00", "baptiste@chivot.fr",password_hash("Coucou", PASSWORD_DEFAULT), 1, 1);

        $db -> create($patient);

        $_POST['email'] = "baptiste@chivot.fr";
        $_POST['motDePasse'] = "Coucou";

        echo("Cas 1");
        $authentif = new AuthentifPatient();

        $_POST['email'] = "baptiste@chivot.fr";
        $_POST['motDePasse'] = "";
 
        echo("Cas 2");
 
        $authentif = new AuthentifPatient();

        $_POST['email'] = "";
        $_POST['motDePasse'] = "Coucou";
        echo("Cas 3");
 
        $authentif = new AuthentifPatient();

        $_POST['email'] = "baptiste@chivot.fr";
        $_POST['motDePasse'] = "Hello";
        echo("Cas 4");
 
        $authentif = new AuthentifPatient();

        var_dump($actual_link);



    }
		
}