<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\RendezVous;
use PDO;

/** 
*	Facturation DAO
*	Implémente l'ensemble des traitements en données pour les rendez-vous.
*	Associé à la logique métier de la classe RendezVous (modele/RendezVous.php).
*/

class RendezVousDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'RendezVous';
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
			'idRdv' => $metier->getIdRdv(),
			'dateRdv' => $metier->getDateRdv(),
			'heureRdv' => $metier->getHeureRdv(),
            'idPatient' => $metier->getIdPatient(),
            'idPraticien' => $metier->getIdPraticien(),
            'idPresta' => $metier->getIdPresta(),
            'idStatutRdv' => $metier->getIdStatutRdv()
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
		$metier->setIdRdv( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idRdv=0): mixed {
		$row = false;
		if($idRdv>0)$row = $this->getOne($idRdv); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : les index fournis (<b>$idRdv</b>) sont invalides !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new RendezVous(...$rowData); //crée l'objet RendezVous(->RendezVous.php) avec toutes les clés du tableau $rowData
		$metier->setIdRdv($idRdv); //ajoute $id dans l'objet métier (Rendezvous)
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
		return $this->updateOne($metier->getIdRdv(), $data);
	}
	
	/** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete($metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdRdv() );
	}

	/**
	*	Méthode permettant l'accès aux données filtrées pour une recherche du prénom ou du nom, 
	*	avec une requête préparée.
	* 	@param string $name Nom ou prénom de l'utilisateur
	* 	@return array
	*/
	public function getRdvById(int $id): mixed {
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE idRdv=:id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

    public function getRdvByDate(string $date): mixed { // renvoie tous les rdv d'une date spécifique
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE dateRdv>:startDate AND dateRdv<:endDate"); // ajouter condition de fin ?
		$stmt->execute([':startDate' => $date, ':endDate' => addOneDay($date)]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

    function addOneDay(string $date, string $format = 'Y-m-d'): string { // ajoute 1 jour à une date passée en paramètre (string) pour les requêtes sql
        $dateTime = DateTime::createFromFormat($format, $date);
        if (!$dateTime) {
            throw new Exception("Format de date invalide : {$date}");
        }
        $dateTime->modify('+1 day');
        return $dateTime->format($format);
    }

	public function annulerRdv($idRdv) {
		$sql = "UPDATE " . $this->tableName . " SET idStatutRdv = 2 WHERE id = :idRdv";
		$stmt = $this->getPdo()->prepare($sql);
		return $stmt->execute([':idRdv' => $idRdv]);
	}

	// /**
	// *	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	// *	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	// *	Le filtre (ici $name) est obligatoirement un tableau !
	// * 	@param string $name Prénom de l'utilisateur
	// * 	@return object
	// */
	// public function getLineFrom(string $name): \stdClass { // ????
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