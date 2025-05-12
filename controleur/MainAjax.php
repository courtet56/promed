<?php

namespace controleur;

use vue\base\Ajax as Ajax;
use app\util\Request as req;
use modele\DAO\UserDAO as Model;
use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\AdresseDAO as AdresseDAO;
use modele\Adresse as Adresse;

use modele\DAO\PatientDAO;
use modele\DAO\RendezVousDAO;
use modele\Praticien as Praticien;
use modele\Patient as Patient;

use modele\DAO\PrestationDAO;
use modele\DAO\ProposeDAO;
use modele\Prestation;
use modele\Propose;

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
			'annulerRdv' => 'annulerRendezVous',
			'connexion' => 'connexion',
			'logout' => 'logout',
			//Fonctionnalités liées à la modification des param du praticien:
			'ajouterModifierPrestation' => 'ajouterModifierPrestation',
			'modifyPraticien' => 'modifyPraticien',
			'selectPresta' => 'selectionnerPrestation',
			'supprPresta' => 'supprimerPrestation'
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
	
	
	// Début Traitement Inscription Praticien :

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
						   return "impossible de récupérer l'id de l'adresse !";
					   }
				   } else {
						return "Echec dans la création de l'adresse !";
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
			return "Captcha invalide !";
		} 
		return true;
	}
	//Fin Traitement Inscription Praticien

	// Début Traitement Modification Praticien :

	protected function modifyPraticien () {

		$name = trim(req::post('nom'));
        $forname = trim(req::post('prenom'));
        $email = trim(req::post('email'));
        $adeli = trim(req::post('adeli'));
        $activity = trim(req::post('activite'));
		$numero = trim(req::post('numero'));
        $rue = trim(req::post('rue'));
		$ville = trim(req::post('ville'));
        $codePostal = trim(req::post('codePostal'));
        $pays = trim(req::post('pays'));
        $oldPassword = trim(req::post('ancienMotDePasse'));
        $newPassword = trim(req::post('nouveauMotDePasse'));

        

		if(!empty($name) 
		&& !empty($forname) 
		&& !empty($email)
		&& !empty($adeli)
		&& !empty($activity)
		&& !empty($numero)
		&& !empty($rue)
		&& !empty($codePostal)
		&& !empty($ville)
		&& !empty($pays))
		{
		
			// Utiliser session quand elle sera disponible : $praticien = $_SESSION['praticien'];
			$praticienDAO = new PraticienDAO();
			$currentPraticien = $praticienDAO->read(19);


			$adresseDAO = new AdresseDAO();
			$currentAdresse = $adresseDAO->read(19);

			$currentName = $currentPraticien->getNom();
			$currentForname = $currentPraticien->getPrenom();
			$currentEmail = $currentPraticien->getEmail();
			$currentAdeli = $currentPraticien->getAdeli();
			$currentActivity = $currentPraticien->getActivite();
			$currentNumero = $currentAdresse->getNumero();
			$currentRue = $currentAdresse->getRue();
			$currentVille = $currentAdresse->getVille();
			$currentCodePostal = $currentAdresse->getCodePostal();	
			$currentPays = $currentAdresse->getPays();
			$currentPassword = $currentPraticien->getMotDePasse();
			

			$modification = false; // Initialisation de la variable de modification

			if(!empty($oldPassword) && !empty($newPassword))
			{	
				if(password_verify($oldPassword, $currentPassword) !== true)
				{
					return "L'ancien mot de passe est incorrect !";
				}
				$isValidatePassword = $this->validatePassword($newPassword);

				if($isValidatePassword != true)
				{
					return $isValidatePassword;
				}

				//MAJ MDP de l'objet currentPraticien Php:
				$currentPraticien->setMotDePasse(password_hash($newPassword, PASSWORD_DEFAULT));
				$praticienDAO->update($currentPraticien);

				$modification = true;
			}

			if($name != $currentName 
			|| $forname != $currentForname 
			|| $email != $currentEmail 
			|| $adeli != $currentAdeli 
			|| $activity != $currentActivity
			|| $numero != $currentNumero
			|| $rue != $currentRue
			|| $ville != $currentVille
			|| $codePostal != $currentCodePostal
			|| $pays != $currentPays)
			{	
				
				$validateForm = $this->validateFormModification($name, $forname, $email,
				$adeli, $activity, $numero, $rue, $codePostal, $ville, $pays);

				if($validateForm != true)
				{
					return $validateForm;
				} 
				//Check pour voir si email et adeli dispo:
				$existingAdeli = $praticienDAO->getPraticienByAdeli($adeli);
				$existingEmail = $praticienDAO->getPraticienByEmail($email);

				/**  si il existe un adeli, on recupère l'id associé à cette adeli et on le compare (id)
				* à celui du currentPraticien de la session :
				*/
				if(!empty($existingAdeli) && $existingAdeli['id'] != $currentPraticien->getId())
				{
					return "Adeli déjà utilisé !";
				}
				if (!empty($existingEmail) && $existingEmail['id'] != $currentPraticien->getId())
				{
					return "Email déjà utilisé !";
				}

				//MAJ de l'objet currentPraticien Php:
				$currentPraticien->setNom($name);
				$currentPraticien->setPrenom($forname);
				$currentPraticien->setEmail($email);
				$currentPraticien->setAdeli($adeli);
				$currentPraticien->setActivite($activity);

				$praticienDAO->update($currentPraticien);

				//MAJ de l'objet currentAdresse Php:
				$currentAdresse->setNumero($numero);
				$currentAdresse->setRue($rue);
				$currentAdresse->setVille($ville);
				$currentAdresse->setCodePostal($codePostal);
				$currentAdresse->setPays($pays);

				$adresseDAO->update($currentAdresse);

				$modification = true;
			}
			
			//Résultat: 
			if($modification == true){
				return "Modification effectuée !";
			} else {
				return "Aucune modification effectuée !";
			}
			
		}
		return "Tous les champs doivent être remplis !";
	}
	// Contrôle du formulaire de modification de profil :
	private function validateFormModification($name, $forname, $email,
		 $adeli, $activity, $numero, $rue, $codePostal, $ville, $pays){
		if(empty($name) 
		|| empty($forname) 
		|| empty($email) 
		|| empty($adeli) 
		|| empty($activity)
		|| empty($numero)
		|| empty($rue)
		|| empty($codePostal)
		|| empty($ville)
		|| empty($pays))
		{
			return "Champs vides !";
		}
		// Vérification du format de l'email
		else if($email != filter_var($email, FILTER_VALIDATE_EMAIL)){
			return "Email invalide !";
		}
		return true;
	}

	// Contrôle pour le changement de mot de passe :
	private function validatePassword($newPassword){

		if(strlen($newPassword) < 8){
			return "Mot de passe trop court !";
		}
		if(!preg_match('/[0-9]/', $newPassword)){
			return "Le mot de passe doit contenir au moins un chiffre !";
		}
		if(!preg_match('/[a-z]/', $newPassword)){
			return "Le mot de passe doit contenir au moins une minuscule !";
		}
		if(!preg_match('/[!@#$%^&*()_+]/', $newPassword)){
			return "Le mot de passe doit contenir au moins un caractère spécial !";
		}
		if(!preg_match('/[A-Z]/', $newPassword)){
			return "Le mot de passe doit contenir au moins une majuscule !";
		}
		 
		
		return true;
		
	} 
	// Fin partie modification paramètres Praticien
	// Début modifications prise en charge Praticien:

	protected function ajouterModifierPrestation (): bool {
		$idPraticien = trim(req::post('userId'));
		$idPresta = trim(req::post('libellePrestation'));

		$proposeDAO = new ProposeDAO();
		$proposition = $proposeDAO->getPropositionByIds($idPraticien, $idPresta);

		$duree = trim(req::post('dureeConsultation'));
		$prix = trim(req::post('prixConsultation'));
		if(empty($duree) && empty($prix)){
			return false;
		}
		if(empty($proposition)){
			$newPropose = new Propose($idPresta, $idPraticien, $duree, $prix);
			return $proposeDAO->create($newPropose); // retourne vrai ou faux
		} else {
			$proposition->setDuree($duree);
			$proposition->setTarif($prix);
			return $proposeDAO->update($proposition);
		} 
	}

	protected function selectionnerPrestation () {
		$idPraticien = trim(req::post('userId'));
		$idPresta = trim(req::post('libellePrestation'));

		$proposeDAO = new ProposeDAO();
		$proposition = $proposeDAO->getPropositionByIds($idPraticien, $idPresta);

		//créer tableau pour envoyer data:
		$reponse = [];
		
		if($proposition != null) {
			$reponse['existe'] = true;
			$reponse['duree'] = $proposition->getDuree();
			$reponse['tarif'] = $proposition->getTarif();
		}
		else{
			$reponse['existe'] = false;
		}

		return json_encode($reponse);
	}

	protected function supprimerPrestation() {
		$idPraticien = 19;
		$idPresta = trim(req::post('idPresta'));

		$proposeDAO = new ProposeDAO();
		$proposeDAO->delete($idPraticien,$idPresta);


	}

	
	protected function annulerRendezVous () {
		$idRdv = trim(req::post('idRdv')); // récupération de l'idrdv envoyé par ajax via POST
		$rdvDao = new RendezVousDAO;
		
		return $rdvDao->annulerRdv($idRdv);
	}

	// debut authentification
	protected function connexion () {
		$email = trim(req::post('email'));
		$mdp = trim(req::post('motDePasse'));
		$captcha = trim(req::post('captcha'));
		$userType = trim(req::post('userType'));
		$user = false;

		if($userType == "patient") {
			$dbPatient = new PatientDAO();
			$userInfo = $dbPatient->getPatientByEmail($email);
		} else if ($userType == "praticien"){
			$dbPraticien = new PraticienDAO();
			$userInfo = $dbPraticien->getPraticienByEmail($email);
		}
		
		if(md5($captcha) !== $_SESSION['captchaCode']) { // vérification du captcha
			return "Captcha incorrect.";
		}

		if(empty($userInfo)) { // cas ou aucune ligne ne correspond a l'email en bd
			return "Ce compte n'existe pas.";
		} else { // création d'objet en fonction
			if($userType == "patient") {
				$user = new Patient($userInfo['nom'], $userInfo['prenom'], $userInfo['dateNaiss'], $userInfo['telephone'], $userInfo['email'], $userInfo['motDePasse'], $userInfo['idTuteur'], $userInfo['idAdresse']);
				$user->setIdPatient($userInfo['id']);
			} else {
				$user = new Praticien($userInfo['nom'], $userInfo['prenom'], $userInfo['email'], $userInfo['activite'], $userInfo['adeli'], $userInfo['motDePasse'], $userInfo['idAdresse']);
				$user->setId($userInfo['id']);
			}
		}

		if(!password_verify($mdp, $user->getMotDePasse())) { // cas ou mdp incorrect
			return "Mot de passe incorrect.";
		}
		$_SESSION['user'] = [
			'email' => $email,
			'userType' => $userType
		];
		return "ok";
	}

	protected function logout() {
		if(isset($_POST['logout']) && $_POST['logout']) {
			if (isset($_SESSION['user'])) {
				unset($_SESSION['user']);
			}
			return 'ok';
		}
		else {
			return false;
		}
	}

	//fin méthode authentification
}




