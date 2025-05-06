<?php

namespace controleur;

use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\PatientDAO as PatientDAO;
use app\util\Request as req;
use modele\Patient;
use vue\base\MainTemplate as Vue;

Class Authentif
{
	public function __construct() {
        // $db = new PatientDAO();
        // $patient = new Patient('Conte', 'Lysa', '2004-05-30', '0601020304', 'lysa.conte@example.com', password_hash('1234', PASSWORD_DEFAULT), 0, 1);
        // $db->create($patient);

        Vue::addCSS([
			ASSET . '/css/accueil.css',
		]);
        Vue::addJS([ASSET . '/js/authentif.js',]);

        Vue::setTitle('Authentification');
        Vue::render('Auth');
    }
		
}