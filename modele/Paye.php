<?php

namespace modele;
use app\util\Error;
use modele\DAO\PayeDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Paye
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/PayeDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Paye".
 */

class Paye {
	
	//Constructeur : Paye
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private int $idFacturation=0,
		private int $idTypePaiement=0,
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
	public function addPaye(): bool {
		$payeDAO = new PayeDAO();
		return $payeDAO->create($this);
	}
	
	/**
	 * Getters
	 */
	
	public function getIdFacturation(): int {
		return $this->idFacturation;
	}
	
	public function getIdTypePaiement(): int {
		return $this->idTypePaiement;
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
	
	public function setIdTypePaiement($idTypePaiement): void {
		$this->idTypePaiement = $idTypePaiement;
	}
	
	public function setMontant($montant): void {
		$this->montant = $montant;
	}
}