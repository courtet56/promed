<?php

namespace controleur;

use modele\DAO\PatientDAO as Model;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;

class Authentification { 

	public function __construct() {
        // dd($_SESSION);
		Vue::setTitle('Bienvenue');

		/**
		 *	Style ou JavaScript supplémentaires (dépendances) que l'on
		 *	souhaite ajouter dans la vue, partie <head></head>
		 *	Voir le fichier : vue/common/header.php
		 */
		Vue::addCSS([
			ASSET . '/css/accueil.css',
		]);

		// ICI pour l'exemple.
		// Il est préférable d'ajouter JQuery dans : vue/common/header.php
		Vue::addJS([
			'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
		]);

		/**
		 *	VUE : Méthode test() :
		 *	Affiche les chemins utilisés pour la vue et arrête l'application
		 *	test() doit être placé avant render()
		 */
		// Vue::test();

		/** 
		 *	VUE : Méthode render()
		 *	Affichage avec la classe MainTemplate (vue/base/MainTemplate.php)
		 *	1/ Nom du fichier sans .php contenu dans le répertoire : vue
		 *	2/ Option : paramètres passés dans un tableau []
		 *	3/ Option (non implémentée ici) : Chemin absolu vers le fichier .php (la vue)
		 *	4/ Option (non implémentée ici) : n’inclus pas le header et le footer
		 */
		Vue::render('Authentification');

	}
}
