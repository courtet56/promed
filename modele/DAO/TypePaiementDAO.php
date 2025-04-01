<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\TypePaiement;
use PDO;

/** 
*	Patient DAO
*	Implémente l'ensemble des traitements en données pour les patients.
*	Associé à la logique métier de la classe Patient (modele/User.php).
*/

class TypePaiementDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'TypePaiement';
		$primaryKey = 'idTypePaiement';
		//-------------------------------------------
		parent::__construct($tableName, $primaryKey);
	}
	
	/** 
	*	Besoins en données issues du métier TypePaiement (modele/TypePaiement.php)
	*	@param object:metier Instance de l'objet metier
	*	@return array
	*/
	private function getAllData(TypePaiement $metier): array {
		return [
			'libelle' => $metier->getLibelle(),
		];
	}

	/** 
	*	CRUD : create
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function create(TypePaiement $metier): bool {
		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setIdTypePaiement( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idTypePaiement = 0): mixed {
		$row = false;
		if($idTypePaiement > 0)$row = $this->getOne($idTypePaiement); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : l'index fourni (<b>$idTypePaiement</b>) est invalide !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
    	// Vérification des valeurs NULL et application de valeurs par défaut
		foreach ($rowData as $key => $value) {
			$rowData[$key] = $value ?? ''; // Remplace NULL par ''
		}
    	
		$metier = new TypePaiement(...$rowData); //crée l'objet User(->User.php) avec toutes les clés du tableau $rowData
		$metier->setIdTypePaiement($idTypePaiement); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
	}
	
	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function update(TypePaiement $metier): bool {
		$data = $this->getAllData($metier);
		//updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->updateOne($metier->getIdTypePaiement(), $data);
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete(TypePaiement $metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdTypePaiement() );
	}

	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
	* 	@param string $name Prénom de l'utilisateur
	* 	@return array
	*/
	public function getTypePaiementById(int $idTypePaiement): array {
		//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE " . $this->primaryKey . " = ?", [$idTypePaiement]);
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
