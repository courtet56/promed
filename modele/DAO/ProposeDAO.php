<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Propose;
use PDO;
use stdClass;

/** 
*	ProposeDAO
*	Implémente l'ensemble des traitements en données pour les utilisateurs.
*	Associé à la logique métier de la classe Propose (modele/Propose.php).
*/

class ProposeDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'Propose';
		$primaryKey = 'idPraticien';
		//-------------------------------------------
		parent::__construct($tableName, $primaryKey);
	}
	
	/** 
	*	Besoins en données issues du métier Propose (modele/Propose.php)
	*	@param object:metier Instance de l'objet métier
	*	@return array
	*/
	private function getAllData($metier): array {
		return [
			'idPraticien' => $metier->getIdPraticien(),
			'idPresta' => $metier->getIdPresta(),
			'duree' => $metier->getDuree(),
			'tarif' => $metier->getTarif(),
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
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $id=0): mixed {
		$rows = false;
		if($id>0)$rows = $this->getAllById($id); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$rows) {
			return [];
		} 
		$metiers = [];
		foreach ($rows as $row){
			$propose = new Propose($row->idPresta, $row->idPraticien, $row->duree,$row->tarif);
			$metiers[] = $propose;
		} //crée l'objet Propose(->Propose.php) avec toutes les clés du tableau $rowData
		return $metiers; //retourne l'objet crée
	}
	
	/** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function update(Propose $metier): bool {
		$data = $this->getAllData($metier);
		$sql = "UPDATE Propose SET duree = :duree, tarif = :tarif WHERE idPraticien = :idPraticien AND idPresta = :idPresta";
		$stmt = self::getPdo()->prepare($sql);
		return $stmt->execute($data);
		
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete($idPrat,$idPresta): bool {
		$sql = "DELETE FROM Propose WHERE idPresta = :idPresta AND idPraticien = :idPrat LIMIT 1;";
        $stmt = self::getPdo()->prepare($sql);
        return $stmt->execute([
			':idPrat' => $idPrat, 
			':idPresta' => $idPresta,
		]);
	}

	/**
	*	Méthode permettant l'accès aux données filtrées pour une recherche du prénom ou du nom, 
	*	avec une requête préparée.
	* 	@param string $name Nom ou prénom de l'utilisateur
	* 	@return array
	*/
	public function getUsersByName(string $name): mixed {
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE prenom LIKE :sname OR nom LIKE :name");
		$stmt->execute([':sname' => "%$name%", ':name' => "%$name%"]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
	* 	@param string $name Prénom de l'utilisateur
	* 	@return object
	*/
	public function getLineFrom(string $name) {
		//sendSQL() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->sendSQL("SELECT * from `" . $this->tableName . "` WHERE prenom = ?", [$name]);
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

	/** Méthode qui prend en paramètre l'id du praticien et  idPrestation
	 * et qui retourne un objet Propose ou null : */ 
	public function getPropositionByIds($idPrat, $idPresta) : ?Propose { // ? = possibilité de retour null
		$sql = "SELECT * FROM {$this->tableName} WHERE idPraticien = :idPraticien and idPresta = :idPrestation";
		$stmt = $this->getPdo()->prepare($sql);
		$stmt->execute([
			':idPraticien' => $idPrat, 
			':idPrestation' => $idPresta,
		]);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		if($result == false){
			return null;
		}
		$propose = new Propose($result->idPresta, $result->idPraticien, $result->duree, $result->tarif);
		return $propose;

	}

	
	
}
