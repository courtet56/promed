<?php

namespace modele;
use app\util\Error;
use modele\DAO\PrestationDAO;
use modele\DAO\ProposeDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Propose
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/ProposeDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Propose".
 */

class Propose {

	private int $idPresta=0; //La clé primaire est identifiée par $id
	private int $idPraticien=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : Propose
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private float $duree=0.0,
		private float $tarif=0.0,
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
	
	// CREATE
	public function addPresta(): bool {
		$prestaDAO = new PrestationDAO();
		return $prestaDAO->create($this);
	}

	/**
	 * Getters
	 */
	
	public function getIdPresta(): int {
		return $this->idPresta;
	}
	
	public function getDuree(): float {
		return $this->duree;
	}
	
	public function getTarif():float	{
		return $this->tarif;
	}
	
	
	/**
	 * Setters
	 */
	
	public function setIdPresta($idPresta): void {
		$this->idPresta = $idPresta;
	}
	
	public function setIdPraticien($idPraticien): void {
		$this->idPraticien = $idPraticien;
	}
	
	public function setDuree($duree): void {
		$this->duree = $duree;
	}
	
	public function setTarif($tarif): void {
		$this->tarif = $tarif;
	}
	

}
