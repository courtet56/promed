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
        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == "patient") {
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
            $patientArray = $db->getPatientByEmail($_SESSION['user']['email']);
            $patient = Patient::fromArray($db->getPatientByEmail($_SESSION['user']['email']));
            $patient = Patient::fromArray($patientArray);
            $patient->setIdPatient($patientArray['id']);

            $currentRdvList = $db->getCurrentRdvByPatient($patient);
            $cancelRdvList = $db->getRdvAnnulesByPatient($patient);
            $oldRdvList = $db->getOldRdvByPatient($patient);

            if(is_array($currentRdvList) && !empty($currentRdvList)) {
                foreach($currentRdvList as $i => $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $currentRdvList[$i]['praticien'] = $praticien->getNom() . " " . $praticien->getPrenom();
                
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $currentRdvList[$i]['presta'] = $prestation->getLibelle();
                }
            }

            if(is_array($cancelRdvList) && !empty($cancelRdvList)) {
                foreach ($cancelRdvList as $i => $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $cancelRdvList[$i]['praticien'] = $praticien->getNom() . " " . $praticien->getPrenom();
                
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $cancelRdvList[$i]['presta'] = $prestation->getLibelle();
                }
            }

            if(is_array($oldRdvList) && !empty($oldRdvList)) {
                foreach($oldRdvList as $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $oldRdvList[$i]['praticien'] = $praticien->getNom() . " " . $praticien->getPrenom();
                
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $oldRdvList[$i]['presta'] = $prestation->getLibelle();    
                }
            }

            Vue::addJS([ASSET . '/js/espacePatient.js']);
            Vue::render('EspacePatient', [
                'currentRdv' => $currentRdvList, // variable html à inclure dans la vue sous le nom $tableRdv
                'cancelRdv' => $cancelRdvList,
                'oldRdv' => $oldRdvList,
                'user' => $patientArray
            ]);

        } else {
            echo "Vous n'êtes pas connecté.";
        }
    
		

        
    }
		
}