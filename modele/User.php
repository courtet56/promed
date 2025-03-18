<?php

namespace modele;
use app\util\Error;
use modele\DAO\UserDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : User
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/UserDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "clients".
 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

class User {

	private int $id=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : User
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private string $nom='',
		private string $prenom='',
		private string $email='',
		private string $tel='',
		private string $dateNaiss='',
		private string $mdp='',
		private string $idTuteur='',
		private string $idAdresse='') {

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
	public function addUser(): bool {
		$userDAO = new UserDAO();
		return $userDAO->create($this);
	}

	// Vérification de l'email
	public function isValidEmail(): bool {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Getters
	 */
	
	public function getId(): int {
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
	}
	
	/**
	 * Setters
	 */
	
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
	}

}
