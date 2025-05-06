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

            $htmlCurrent = '';

            if(is_array($currentRdvList) && !empty($currentRdvList)) { // construction ligne par ligne du tableau contenant les rdv en cours
                $htmlCurrent .= "<thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                <th scope='col'></th>
                </tr>
            </thead>";
                foreach($currentRdvList as $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $htmlCurrent .= '<tr><td>' . $curRdv["dateRdv"] . "</td><td>" .
                            $curRdv["heureRdv"] . "</td><td>" . $praticien->getNom() . " " . $praticien->getPrenom() . "</td><td>" .
                            $prestation->getLibelle() . "</td><td><button type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='" . $curRdv['id'] . "'>Annuler</button></td>\n";
                }
                $htmlCurrent .= "</tbody>";
            } else {
                $htmlCurrent .= "Vous n'avez aucun rendez-vous de prévu pour le moment.";
            }

            $htmlCancel = '';

            if(is_array($cancelRdvList) && !empty($cancelRdvList)) { // construction ligne par ligne du tableau contenant les rdv7
                $htmlCancel .= "<thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                <th scope='col'></th>
                </tr>
            </thead><tbody>";
                foreach($cancelRdvList as $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $htmlCancel .= '<tr><td>' . $curRdv["dateRdv"] . "</td><td>" .
                            $curRdv["heureRdv"] . "</td><td>" . $praticien->getNom() . " " . $praticien->getPrenom() . "</td><td>" .
                            $prestation->getLibelle() . "</td><td><button disabled type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='" . $curRdv['id'] . "'>Annulé</button></td>\n";
                }
                $htmlCancel .= "</tbody>";
            } else {
                $htmlCancel .= "Vous n'avez aucun rendez-vous annulé pour le moment.";
            }

            $htmlOld = '';

            if(is_array($oldRdvList) && !empty($oldRdvList)) { // construction ligne par ligne du tableau contenant les rdv7
                $htmlOld .= "<thead>
                <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Heure</th>
                <th scope='col'>Praticien</th>
                <th scope='col'>Prise en charge</th>
                <th scope='col'></th>
                </tr>
            </thead><tbody>";
                foreach($oldRdvList as $curRdv) {
                    $praticien = $dbPrat->read($curRdv["idPraticien"]);
                    $prestation = $dbPresta->read($curRdv['idPresta']);
                    $htmlOld .= '<tr><td>' . $curRdv["dateRdv"] . "</td><td>" .
                            $curRdv["heureRdv"] . "</td><td>" . $praticien->getNom() . " " . $praticien->getPrenom() . "</td><td>" .
                            $prestation->getLibelle() . "</td><td><button disabled type='button' class='btn cancelBtn' data-bs-toggle='modal' data-bs-target='#cancelModal' idRdv='" . $curRdv['id'] . "'>Annuler</button></td>\n";
                }
                $htmlOld .= "</tbody>";
            } else {
                $htmlOld .= "Vous n'avez aucun rendez-vous de passé pour le moment.";
            }

            Vue::addJS([ASSET . '/js/espacePatient.js']);
            Vue::render('EspacePatient', [
                'currentRdv' => $htmlCurrent, // variable html à inclure dans la vue sous le nom $tableRdv
                'cancelRdv' => $htmlCancel,
                'oldRdv' => $htmlOld,
                'user' => $patientArray
            ]);

        } else {
            echo "Vous n'êtes pas connecté.";
        }
    
		

        
    }
		
}