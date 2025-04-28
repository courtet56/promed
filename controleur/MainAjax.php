<?php

namespace controleur;

use vue\base\Ajax as Ajax;
use app\util\Request as req;
use modele\DAO\UserDAO as Model;
use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\AdresseDAO as AdresseDAO;
use modele\Adresse as Adresse;
use modele\Praticien as Praticien;


/**
 *	Classe chargée depuis le routing : route/routing.php
 *	==> $route->add('/ajax', 'controleur\MainAjax'); 
 *	Pour TESTER : http://localhost/apptest/ajax
 *	Avec le paramètre : 
 *	http://localhost/apptest/ajax?findUsers
 *	==> retourne false car aucun $_POST['name'], voir :
 *	vue/ajax/ajaxRechercher.php , ligne 36
 */

class MainAjax extends Ajax {

	private $db;

	/**
	 *	--------------------
	 *	   AJAX : ROUTES
	 *	--------------------
	 */

	/**
	 * Collection par un tableau des requêtes de type GET pour AJAX
	 * Est ajouté [ 'AjaxNom' => 'methodNom' ] : 
	 * 1/ AjaxNom = le nom reçu par l'url : /ajax?nom
	 * 2/ methodNom = le nom de la méthode utilisée dans cette classe.
	 */
	private function ajaxRoute(): array {
		return [
			// - "findUsers" est utilisé dans : vue/ajax/ajaxRechercher.php
			// - la méthode protégée : "getUserBySearch" est implémentée ci-dessous.
			'findUsers' => 'getUserBySearch',
			'newPraticien' => 'inscriptionPraticien',
			// - D'autres lignes ?
		];
	}

	/**
	 * Chargement des routes AJAX
	 * Réception du tableau des requêtes de type GET pour AJAX
	 * Charge le constructeur de la classe Ajax() héritée dans : vue/ajax/base/Ajax.php
	 * @param string $message Retourne le message par défaut, ceci n'est pas indispensable.
	 */
	public function __construct(string $message='') {

		if(!empty($message)) {
			$this->message = $message;
		}

		$this->db = new Model();
		
		$route = $this->ajaxRoute();
		
		foreach($route as $k => $v) {
			if( isset($_GET[$k]) ) {
				$this->method = $v; //méthode héritée de : vue/base/Ajax.php
			}
		}

		//constructeur de la classe Ajax() (vue/base/Ajax.php) :
		parent::__construct();
	}
	
	/**
	 *	--------------------
	 *	   AJAX : METHODS
	 *	--------------------
	 */

	/**
	 * Nom de la méthode qui sera chargée dans ce constructeur avec $this->method
	 * ==> voir au-dessus le tableau dans la fonction ajaxRoute().
	 * @return mixed Retourne le nom ou le prénom recherché, ou false
	 */
	
	

	protected function inscriptionPraticien () {

		$nom = trim(req::post('nom'));
        $prenom = trim(req::post('prenom'));
        $email = trim(req::post('email'));
        $adeli = trim(req::post('adeli'));
        $activite = trim(req::post('activite'));
        $numero = trim(req::post('numero'));
        $rue = trim(req::post('rue'));
        $codePostal = trim(req::post('codePostal'));
        $ville = trim(req::post('ville'));
        $pays = trim(req::post('pays'));
        $motDePasse = password_hash(trim(req::post('motDePasse')), PASSWORD_DEFAULT);
		$captcha = trim(req::post('captcha'));


		$validateForm = $this->validateForm($nom, $prenom, $email, $adeli, $activite, $numero, $rue, $codePostal, $ville, $pays, $motDePasse, $captcha);

		if($validateForm !== true){
			return $validateForm;
		}
		
		$praticienDAO = new PraticienDAO();
		$adresseDAO = new AdresseDAO();
	

		if(!empty($_POST)){
       
			$existingPraticien = $praticienDAO->getPraticienByEmail($email);

			   if(!empty($existingPraticien)){
				   // TODO retourner message d'erreur : email déjà utilisé
				   return "email déjà utilisé !";
			   } else {
				   $adresse = new Adresse($numero, $rue, $codePostal, $ville, $pays);
				   if($adresseDAO->create($adresse)){
					   $idAdresse = $adresseDAO->getLastKey();
					   if($idAdresse >0){
						   $praticien = new Praticien($nom, $prenom, $email, $activite, $adeli, $motDePasse, $idAdresse);
						   if($praticienDAO->create($praticien)){
							   // TODO rediriger vers la page de connexion (appel de la méthode connection)
							   
							   return "ok";
						   } else {
							   return "inscription échouée, échec dans la création du praticien en bdd !";
						   }
					   } else {
						   return "impossible de réucpérer l'id de l'adresse !";
					   }
				   } else {
						return "Création Adresse échouée ! Inscription échouée !";
				   }
			   }
		} else {
				return "Champ vide !";
		}
		   
	}

	private function validateForm($nom, $prenom, $email, $adeli, $activite, $numero, $rue, $codePostal, $ville, $pays, $motDePasse, $captcha) {


		if(empty($nom) || empty($prenom) || empty($email) || empty($adeli) || empty($activite) || 
			empty($numero) || empty($rue) || empty($codePostal) || empty($ville) || empty($pays) || 
			empty($motDePasse) || empty($captcha)
		){
			return "Champs vides !";
		} 

		// Vérification du format de l'email
		if($email != filter_var($email, FILTER_VALIDATE_EMAIL)){
			return "Email invalide !";
		}

		// Vérification du format mot de passe
		if(strlen($motDePasse) < 8){
			return "Mot de passe trop court !";
		}
		if(!preg_match('/[0-9]/', $motDePasse)){
			return "Le mot de passe doit contenir au moins un chiffre !";
		}
		if(!preg_match('/[a-z]/', $motDePasse)){
			return "Le mot de passe doit contenir au moins une minuscule !";
		}
		if(!preg_match('/[!@#$%^&*()_+]/', $motDePasse)){
			return "Le mot de passe doit contenir au moins un caractère spécial !";
		}
		if(!preg_match('/[A-Z]/', $motDePasse)){
			return "Le mot de passe doit contenir au moins une majuscule !";
		}
		
		if(md5($captcha) !== $_SESSION["captchaCode"]){
			return "saisie du captcha " . $captcha . " hashée : " . md5($captcha) . "\n captcha de la session : " . $_SESSION['captchaCode'];
		} 
		return true;
	}

}



