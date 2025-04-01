<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Patient;
use PDO;

/** 
*	Patient DAO
*	Implémente l'ensemble des traitements en données pour les patients.
*	Associé à la logique métier de la classe Patient (modele/User.php).
*/

class PatientDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'Patient';
		$primaryKey = 'idPatient';
		//-------------------------------------------
		parent::__construct($tableName, $primaryKey);
	}
	
	/** 

	*	Besoins en données issues du métier Patient (modele/Patient.php)
	*	@param object:metier Instance de l'objet metier
	*	@return array
	*/
	private function getAllData(Patient $metier): array {
		return [
			'nom' => $metier->getNom(),
			'prenom' => $metier->getPrenom(),
			'dateNaiss' => $metier->getDateNaiss(),
			'telephone' => $metier->getTelephone(),
			'email' => $metier->getEmail(),
			'motDePasse' => $metier->getMotDePasse(),
			'idTuteur' => $metier->getIdTuteur(),
			'idAdresse' => $metier->getIdAdresse(),
		];
	}

	/** 
	*	CRUD : create
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function create(Patient $metier): bool {
		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setIdPatient( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idPatient = 0): mixed {
		$row = false;
		if($idPatient > 0)$row = $this->getOne($idPatient); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : l'index fourni (<b>$idPatient</b>) est invalide !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
    	// Vérification des valeurs NULL et application de valeurs par défaut
		foreach ($rowData as $key => $value) {
			$rowData[$key] = $value ?? ''; // Remplace NULL par ''
		}
    	// Vérification spécifique pour les INT
    	$rowData['idTuteur'] = isset($rowData['idTuteur']) ? (int) $rowData['idTuteur'] : 0;
    	$rowData['idAdresse'] = isset($rowData['idAdresse']) ? (int) $rowData['idAdresse'] : 0;

		$metier = new Patient(...$rowData); //crée l'objet User(->User.php) avec toutes les clés du tableau $rowData
		$metier->setIdPatient($idPatient); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
	}
	
	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function update(Patient $metier): bool {
		$data = $this->getAllData($metier);
		//updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->updateOne($metier->getIdPatient(), $data);
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete(Patient $metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdPatient() );
	}
	
	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
	* 	@param string $email Email de l'utilisateur
	* 	@return array
	*/
	public function getPatientByEmail(string $email): array|bool {
		//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE email = ?", [$email]);
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
