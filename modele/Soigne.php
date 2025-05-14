<?php

namespace modele;
use app\util\Error;
use modele\DAO\SoigneDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : 
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/SoigneDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Paye".
 */

class Soigne {
	
	//Constructeur : Soigne
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private int $idPraticien=0,
		private int $idPatient=0
		
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
	public function addSoigne(): bool {
		$SoigneDAO = new SoigneDAO();
		return $SoigneDAO->create($this);
	}
	
	/**
	 * Getters
	 */
	
	public function getIdPraticien(): int {
		return $this->idPraticien;
	}
	
	public function getIdPatient(): int {
		return $this->idPatient;
	}
	
	
	/**
	 * Setters
	 */
	
	public function setIdPraticien($idPraticien): void {
		$this->idPraticien = $idPraticien;
	}
	
	public function setIdPatien($idPatient): void {
		$this->idPatient = $idPatient;
	}
	
}