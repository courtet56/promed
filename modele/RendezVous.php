<?php

namespace modele;
use app\util\Error;
use modele\DAO\RendezVousDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : User
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/UserDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "clients".
 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

class RendezVous {

    private int $idRdv=0; //La clé primaire est identifiée par $idRdv
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : User
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
        private string $dateRdv=0,
        private string $heureRdv=0,
		private int $idPatient=0,
        private int $idPraticien=0,
		private int $idPresta=0,
        private int $idStatutRdv=0
        ) {

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
	
	// // CREATE
	public function addRdv(): bool {
		$rdvDAO = new RendezVousDAO();
		return $rdvDAO->create($this);
	}
	
	/**
	 * Getters
	 */
	
	public function getIdRdv(): int {
		return $this->idRdv;
	}

    public function getDateRdv(): string {
		return $this->dateRdv;
	}
	
	public function getHeureRdv(): string {
		return $this->heureRdv;
	}

    public function getIdPatient(): int {
		return $this->idPatient;
	}
	
	public function getIdPraticien(): int {
		return $this->idPraticien;
	}

    public function getIdPresta(): int {
		return $this->idPresta;
	}

    public function getIdStatutRdv(): int {
		return $this->idStatutRdv;
	}
	
	
	/**
	 * Setters
	 */
	
	public function setIdRdv($idRdv): void {
		$this->idRdv = $idRdv;
	}

    public function setDateRdv($dateRdv): void {
		$this->dateRdv = $dateRdv;
	}
	
	public function setIdTypePaiement($heureRdv): void {
		$this->heureRdv = $heureRdv;
	}

    public function setIdPatient($idPatient): void {
		$this->idPatient = $idPatient;
	}
	
	public function setIdPraticien($idPraticien): void {
		$this->idPraticien = $idPraticien;
	}

    public function setIdPresta($idPresta): void {
		$this->idPresta = $idPresta;
	}

    public function setIdStatutRdv($idStatutRdv): void {
		$this->idStatutRdv = $idStatutRdv;
	}
}