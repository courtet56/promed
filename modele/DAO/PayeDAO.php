<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Paye;
use PDO;

/** 
*	Paye DAO
*	Implémente l'ensemble des traitements en données pour les utilisateurs.
*	Associé à la logique métier de la classe Paye (modele/Paye.php).
*/

class PayeDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'Paye';
		$primaryKey = ['idFacturation', 'idTypePaiement'];
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
			'idFacturation' => $metier->getIdFacturation(),
			'idTypePaiement' => $metier->getIdTypePaiement(),
			'montant' => $metier->getMontant(),
		];
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
		$metier->setId( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idFacturation=0, int $idTypePaiement = 0): mixed {
		$row = false;
		if($idFacturation>0 && $idTypePaiement>0)$row = $this->getOne(["idFacturation" => $idFacturation, "idTypePaiement" => $idTypePaiement]); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : les index fournis (<b>$idFacturation, $idTypePaiement</b>) sont invalides !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new Paye(...$rowData); //crée l'objet Paye(->Paye.php) avec toutes les clés du tableau $rowData
		$metier->setIdFacturation($idFacturation); //ajoute $id dans l'objet métier (Paye)
        $metier->setIdFacturation($idTypePaiement);
		return $metier; //retourne l'objet créé
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
	* 	@param string $name Nom ou prénom de l'utilisateur
	* 	@return array
	*/
	// public function getUsersByName(string $name): mixed {
	// 	$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE prenom LIKE :sname OR nom LIKE :name");
	// 	$stmt->execute([':sname' => "%$name%", ':name' => "%$name%"]);
	// 	return $stmt->fetch(PDO::FETCH_ASSOC);
	// }

	// /**
	// *	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	// *	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	// *	Le filtre (ici $name) est obligatoirement un tableau !
	// * 	@param string $name Prénom de l'utilisateur
	// * 	@return object
	// */
	// public function getLineFrom(string $name): \stdClass {
	// 	//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
	// 	return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE prenom = ?", [$name]);
	// }
	
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