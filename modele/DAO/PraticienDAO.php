<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Praticien;
use PDO;

/** 
*	PraticienDAO
*	Implémente l'ensemble des traitements en données pour les praticiens.
*	Associé à la logique métier de la classe Praticien (modele/Praticien.php).
*/

class PraticienDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'Praticien';
		$primaryKey = 'id';
		//-------------------------------------------
		parent::__construct($tableName, $primaryKey);
	}
	
	/** 
	*	Besoins en données issues du métier User (modele/User.php)
	*	@param object:metier Instance de l'objet métier
	*	@return array
	*/
	private function getAllData($metier): array {
		return [
			'nom' => $metier->getNom(),
			'prenom' => $metier->getPrenom(),
			'email' => $metier->getEmail(),
			'activite' => $metier->getActivite(),
			'adeli' => $metier->getAdeli(),
			'motDePasse' => $metier->getMotDePasse(),
			'idAdresse' => $metier->getIdAdresse(),
			
		];
	}
	public function getAgendaPraticien($email): array{

		
		$stmt=$this ->getPdo()-> prepare('SELECT
	
   		Patient.nom AS nomPatient,
		Patient.prenom AS prenomPatient,
    	prestation.libelle AS libellePrestation,
    	RendezVous.heureRdv AS heureRdv,
		StatutRdv.libelle AS libelleStatutRdv
		FROM
    	RendezVous
		INNER JOIN Prestation ON RendezVous.idPresta = prestation.idPresta
		INNER JOIN Patient ON Patient.idPatient = RendezVous.idPatient
		INNER JOIN Praticien ON Praticien.id = RendezVous.id
		INNER JOIN StatutRdv ON StatutRdv.idStatutRdv = RendezVous.idStatutRdv
		where dateRdv = CURDATE() AND Praticien.email = ?;

	');
	
	$stmt->execute([$email]);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;



	}

	/** 
	*	CRUD : create
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function create($metier): bool {
		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setid( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $id=0): mixed {
		$row = false;
		if($id>0)$row = $this->getOne($id); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : l'index fourni (<b>$id</b>) est invalide !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new Praticien(...$rowData); //crée l'objet Praticien(->Praticien.php) avec toutes les clés du tableau $rowData
		$metier->setid($id); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
	}
	

	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function update($metier): bool {
		$data = $this->getAllData($metier);
		//updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->updateOne($metier->getId(), $data);
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete($metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getId() );
	}

	/**
	*	Méthode permettant l'accès aux données filtrées pour une recherche du prénom ou du nom, 
	*	avec une requête préparée.
	* 	@param string $email Nom ou prénom de l'utilisateur
	* 	@return array
	*/

	
	public function getPraticienByEmail(string $email): mixed {
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE email=  :email");
		$stmt->execute([':email' => $email]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function getPraticienByAdeli(string $adeli): mixed {
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE adeli=  :adeli");
		$stmt->execute([':adeli' => $adeli]);
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}

	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $email) est obligatoirement un tableau !
	* 	@param string $email Prénom de l'utilisateur
	* 	@return array|null
	*/
	public function getLineFrom(string $email) {
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
