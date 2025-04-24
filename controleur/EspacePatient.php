<?php

namespace controleur;

use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\PatientDAO as PatientDAO;
use app\util\Request as req;
use modele\DAO\PrestationDAO;
use modele\Patient;
use ParentIterator;
use vue\base\MainTemplate as Vue;

Class EspacePatient
{
	public function __construct() {
    
		/**
		 *	--------------
		 *	    MODELE
		 *	--------------
		 */

		/**
		 *	MODELE : Instance de PraticienDAO et PatientDAO
		 */
        $dbPrat = new PraticienDAO;
		$db = new PatientDAO();
        $dbPresta = new PrestationDAO;
        $patient = new Patient('MACRON', 'Emmanuel', '1977-12-21', '1234567890', 'emmanuel.macron@example.com', '1234', 1, 1);
        $patient->setIdPatient(1);

        $rdvList = $db->getRdvByPatient($patient);
        // echo "<pre>";
        // print_r($rdvList);
        // echo "</pre>";

        $html = '';

        if(is_array($rdvList)) { // construction ligne par ligne du tableau contenant les rdv
            foreach($rdvList as $curRdv) {
                $praticien = $dbPrat->read($curRdv["idPraticien"]);
                $prestation = $dbPresta->read($curRdv['idPresta']);
                $html .= '<tr><td>' . $curRdv["dateRdv"] . "</td><td>" .
                        $curRdv["heureRdv"] . "</td><td>" . $praticien->getNom() . " " . $praticien->getPrenom() . "</td><td>" .
                        $prestation->getLibelle() . "</td><td><button type='button' class='btn'>Annuler</button></td>\n";
            }
        }

        Vue::render('EspacePatient', [
            'tableRdv' => $html // variable html à inclure dans la vue sous le nom $tableRdv
        ]);
        
    }
		
}