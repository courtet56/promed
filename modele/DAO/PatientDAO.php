<?php

namespace modele\DAO;

use modele\DAO\base\Database;
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
use modele\Patient;
use PDO;

/** 
*	Patient DAO
*	Implémente l'ensemble des traitements en données pour les patients.
*	Associé à la logique métier de la classe Patient (modele/User.php).
*/

class PatientDAO extends Database {
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb

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
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
			'idAdresse' => $metier->getIdAdresse(),
		];
	}

	/** 
	*	CRUD : create
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	public function create(Patient $metier): bool {
		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setIdPatient( $this->getLastKey() );
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
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
<<<<<<< HEAD
		$metier->setIdPatient($idPatient); //ajoute $id dans l'objet métier (User)		return $metier; //retourne l'objet crée
=======
		$metier->setIdPatient($idPatient); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	}
	
	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	public function update(Patient $metier): bool {
		$data = $this->getAllData($metier);
		//updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->updateOne($metier->getIdPatient(), $data);
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	public function delete(Patient $metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdPatient() );
	}
	
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
	* 	@param string $email Email de l'utilisateur
	* 	@return array
	*/
	public function getPatientByEmail(string $email): array|bool {
		//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE email = ?", [$email]);
<<<<<<< HEAD

=======
>>>>>>> 3429fbed9d8ea312f6931868b47a438db98b9dbb
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
