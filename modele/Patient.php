<?php

namespace modele;
use app\util\Error;
<<<<<<< HEAD
use modele\DAO\UserDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : User
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/UserDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "clients".
=======
use modele\DAO\PatientDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Patient
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/PatientDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Pyatient".
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10
 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

<<<<<<< HEAD
class User {
=======
class Patient {
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10

	private int $id=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : User
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private string $nom='',
		private string $prenom='',
<<<<<<< HEAD
		private string $email='',
		private string $tel='',
		private string $dateNaiss='',
		private string $mdp='',
		private string $idTuteur='',
		private string $idAdresse='') {
=======
		private string $dateNaiss='',
		private string $telephone='',
		private string $email='',
		private string $motDePasse='',
		private int $idTuteur=0,
		private int $idAdresse=0) {
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10

		//Gestionnaire d'erreur (pour les requêtes) :
		try {
			Error::checkModelArgs(get_object_vars($this), __CLASS__ , func_get_args());
		} catch (\InvalidArgumentException $e) {
			$err = "Erreur : " . $e->getMessage();
			$err .= Error::print($e->getTrace(), 1);
			exit($err);
		}
	}
	
	/**
	 * Methods
	 */		
	
	// CREATE
<<<<<<< HEAD
	public function addUser(): bool {
		$userDAO = new UserDAO();
		return $userDAO->create($this);
=======
	public function addPatient(): bool {
		$patientDAO = new PatientDAO();
		return $patientDAO->create($this);
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10
	}

	// Vérification de l'email
	public function isValidEmail(): bool {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Getters
	 */
	
<<<<<<< HEAD
	public function getId(): int {
=======
	public function getIdPatient(): int {
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10
		return $this->id;
	}
	
	public function getNom(): string {
		return $this->nom;
	}
	
	public function getPrenom(): string	{
		return $this->prenom;
	}
	
	public function getEmail(): string {
		return $this->email;
	}
	
<<<<<<< HEAD
	public function getDateNaissance(): string {
		return $this->dateNaiss;
	}
	
	public function getMdp(): string {
		return $this->mdp;
	}
	
	public function getIdAdresse(): string {
		return $this->idAdresse;
	}
	
	public function getIdTuteur(): string {
		return $this->idTuteur;
	}
	
	public function getTel(): string {
		return $this->tel;
=======
	public function getDateNaiss(): string {
		return $this->dateNaiss;
	}
	
	public function getMotDePasse(): string {
		return $this->motDePasse;
	}
	
	public function getIdAdresse(): int {
		return $this->idAdresse;
	}
	
	public function getIdTuteur(): int {
		return $this->idTuteur;
	}
	
	public function getTelephone(): string {
		return $this->telephone;
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10
	}
	
	/**
	 * Setters
	 */
	
<<<<<<< HEAD
	public function setId($id): void {
		$this->id = $id;
	}
	
	public function setNom($nom): void {
		$this->nom = $nom;
	}
	
	public function setPrenom($prenom): void {
		$this->prenom = $prenom;
	}
	
	public function setEmail($email): void {
		$this->email = $email;
	}
	
	public function setDateNaissance($ne_le): void {
		$this->dateNaiss = $ne_le;
	}
	
	public function setIdTuteur($idTuteur): void {
		$this->idTuteur = $idTuteur;
	}
	
	public function setIdAdresse($idAdresse): void {
		$this->idAdresse = $idAdresse;
	}
	
	public function setTel($tel): void {
		$this->tel = $tel;
	}

	public function setMdp($mdp): void {
		$this->mdp = $mdp;
=======
	public function setIdPatient(int $idPatient): void {
		$this->id = $idPatient;
	}
	
	public function setNom(string $nom): void {
		$this->nom = $nom;
	}
	
	public function setPrenom(string $prenom): void {
		$this->prenom = $prenom;
	}
	
	public function setEmail(string $email): void {
		$this->email = $email;
	}
	
	public function setDateNaiss(string $dateNaiss): void {
		$this->dateNaiss = $dateNaiss;
	}
	
	public function setIdTuteur(int $idTuteur): void {
		$this->idTuteur = $idTuteur;
	}
	
	public function setIdAdresse(int $idAdresse): void {
		$this->idAdresse = $idAdresse;
	}
	
	public function setTelephone(string $telephone): void {
		$this->telephone = $telephone;
	}

	public function setMotDePasse(string $motDePasse): void {
		$this->motDePasse = $motDePasse;
>>>>>>> 582f3bf7c610af686a8ef56488f433f3a8886b10
	}

}
