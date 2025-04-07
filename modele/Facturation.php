<?php

namespace modele;
use app\util\Error;
use modele\DAO\FacturationDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Facturation
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/FacturationDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Facturation".
 */

class Facturation {

	private int $idFacturation=0; //La clé primaire est identifiée par $idFacturation
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : Facturation
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
        private string $dateFacturation='',
		private int $idStatutFact=0,
        private int $idStatutRdv=0,
		private float $montant=0
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
	public function addFacturation(): bool {
		$factDAO = new FacturationDAO();
		return $factDAO->create($this);
	}
	
	/**
	 * Getters
	 */
	
	public function getIdFacturation(): int {
		return $this->idFacturation;
	}

    public function getDateFacturation(): string {
		return $this->dateFacturation;
	}
	
	public function getIdStatutFact(): int {
		return $this->idStatutFact;
	}

    public function getIdStatutRdv(): int {
		return $this->idStatutRdv;
	}
	
	public function getMontant(): float	{
		return $this->montant;
	}
	
	
	/**
	 * Setters
	 */
	
	public function setIdFacturation($idFacturation): void {
		$this->idFacturation = $idFacturation;
	}

    public function setDateFacturation($dateFacturation): void {
		$this->dateFacturation = $dateFacturation;
	}
	
	public function setIdStatutFact($idStatutFact): void {
		$this->idStatutFact = $idStatutFact;
	}

    public function setIdStatutRdv($idStatutRdv): void {
		$this->idStatutRdv = $idStatutRdv;
	}
	
	public function setMontant($montant): void {
		$this->montant = $montant;
	}
}