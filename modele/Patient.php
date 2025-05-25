<?php

namespace modele;
use app\util\Error;
use modele\DAO\PatientDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Patient
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/PatientDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Pyatient".

 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

class Patient {

	private int $id=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : Patient
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private string $nom='',
		private string $prenom='',
		private string $dateNaiss='',
		private string $telephone='',
		private string $email='',
		private string $motDePasse='',
		private int $estTuteur=0,
		private int $idTuteur=0,
		private int $idAdresse=0) {

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
	public function addPatient(): bool {
		$patientDAO = new PatientDAO();
		return $patientDAO->create($this);
	}

	// Vérification de l'email
	public function isValidEmail(): bool {
		return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Getters
	 */
	
	public function getIdPatient(): int {
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

	public function getEstTuteur(): int {
		return $this->estTuteur;
	}
	
	public function getTelephone(): string {
		return $this->telephone;
	}
	
	/**
	 * Setters
	 */
	
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
	public function setEstTuteur(int $estTuteur): void {
		$this->estTuteur = $estTuteur;
	}

	public function setMotDePasse(string $motDePasse): void {
		$this->motDePasse = $motDePasse;
	}

	public static function fromArray(array $data): Patient {
		$retour = new Patient($data['nom'] ?? '',
			$data['prenom'] ?? '',
			$data['dateNaiss'] ?? '',
			$data['telephone'] ?? '',
			$data['email'] ?? '',
			$data['motDePasse'] ?? '',
			(int)$data['estTuteur'] ?? 0,
			(int)$data['idTuteur'] ?? 0,
			(int)$data['idAdresse'] ?? 0);
		$retour->setIdPatient($data['id'] ?? 0);
		return $retour;
	}

	public function toArray(): array {
		return [
			'id' => $this->id,
			'nom' => $this->nom,
			'prenom' => $this->prenom,
			'dateNaiss' => $this->dateNaiss,
			'telephone' => $this->telephone,
			'email' => $this->email,
			'idTuteur' => $this->idTuteur,
			'idAdresse' => $this->idAdresse,
		];
	}


}
