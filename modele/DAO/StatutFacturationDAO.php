<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\StatutFacturation;
use PDO;

/** 
*	Patient DAO
*	Implémente l'ensemble des traitements en données pour le statut facturation.
*	Associé à la logique métier de la classe StatutFacturation (modele/StatutFacturation.php).
*/

class StatutFacturationDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'StatutFacturation';
		$primaryKey = 'idStatutFact';
		//-------------------------------------------
		parent::__construct($tableName, $primaryKey);
	}
	
	/** 
	*	Besoins en données issues du métier StatutFacturation (modele/StatutFacturation.php)
	*	@param object:metier Instance de l'objet metier
	*	@return array
	*/
	private function getAllData(StatutFacturation $metier): array {
		return [
			'libelle' => $metier->getLibelle(),
		];
	}

	/** 
	*	CRUD : create
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function create(StatutFacturation $metier): bool {
		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setIdStatutFacturation( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idStatutFacturation = 0): mixed {
		$row = false;
		if($idStatutFacturation > 0)$row = $this->getOne($idStatutFacturation); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : l'index fourni (<b>$idStatutFacturation</b>) est invalide !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
    	// Vérification des valeurs NULL et application de valeurs par défaut
		foreach ($rowData as $key => $value) {
			$rowData[$key] = $value ?? ''; // Remplace NULL par ''
		}
    	
		$metier = new StatutFacturation(...$rowData); //crée l'objet User(->User.php) avec toutes les clés du tableau $rowData
		$metier->setIdStatutFacturation($idStatutFacturation); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
	}
	
	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function update(StatutFacturation $metier): bool {
		$data = $this->getAllData($metier);
		//updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->updateOne($metier->getIdStatutFacturation(), $data);
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete(StatutFacturation $metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdStatutFacturation() );
	}

	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
	* 	@param string $name Prénom de l'utilisateur
	* 	@return array
	*/
	public function getStatutFacturationById(int $idStatutFacturation): array {
		//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE " . $this->primaryKey . " = ?", [$idStatutFacturation]);
	}
		
	/**
	* Utils infos
	*/
	
	public function getTableName(): string {
		return $this->tableName;
	}
	
	public function getPrimaryKey(): string {
		return $this->primaryKey;
	}
	
}
