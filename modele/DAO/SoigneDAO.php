<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Soigne;
use PDO;

/** 
*	Soigne DAO
*	Implémente l'ensemble des traitements en données pour les utilisateurs.
*	Associé à la logique métier de la classe Paye (modele/Soigne.php).
*/

class SoigneDAO extends Database {

	/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

	public function __construct() {
		//-------------------------------------------
		$tableName = 'Soigne';
		$primaryKey = ['idPraticien', 'idPatient'];
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
			'idPraticien' => $metier->getIdPraticien(),
			'idPatient' => $metier->getIdPatient(),
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
		// $metier->setId( $this->getLastKey() );
		return $bool;
	}

	/** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
	public function read(int $idPraticien=0, int $idPatient = 0): mixed {
		$row = false;
		if($idPraticien>0 && $idPatient>0)$row = $this->getOne(["idPraticien" => $idPraticien, "idPatient" => $idPatient]); //on récupère la ligne/tuple concernée
		//gestion de l'index en cas d'erreur :
		if(!$row) {
			die( __CLASS__ . "->read() : les index fournis (<b>$idPraticien, $idPatient</b>) sont invalides !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new Soigne(...$rowData); //crée l'objet Soigne(->Soigne.php) avec toutes les clés du tableau $rowData
		$metier->setidPraticien($idPraticien); //ajoute $id dans l'objet métier (Soigne)
        $metier->setIdPatient($idPatient);
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
	//  Méthode qui prend en paramètre l'id du praticien et renvoie un array avec id,
    //  nom et prenom des patients associés auu praticien :
    public function getAllPatientsFromPraticien(int $idPraticien):array {
         return $this->sendSQL("SELECT
                Patient.id AS idPatient,
                Patient.nom AS nomPatient,
                Patient.prenom AS prenomPatient
         FROM Soigne
             INNER JOIN Patient ON Soigne.idPatient = Patient.id
             INNER JOIN Praticien ON Soigne.idPraticien = Praticien.id
             WHERE Praticien.id = ?;
            ", [$idPraticien]);
    }

    public function getListePatientPraticien(string $email):array{

         return $this->sendSQL("SELECT
                Patient.id AS idPatient,
                Patient.nom AS nomPatient,
                Patient.prenom AS prenomPatient
         FROM Soigne
             INNER JOIN Patient ON Soigne.idPatient = Patient.id
             INNER JOIN Praticien ON Soigne.idPraticien = Praticien.id
             WHERE Praticien.email = ?;
            ", [$email]);



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


    // suppression d'un patient pour un praticien donné
    public function deletePatient($idPatient, $idPraticien) {
    $stmt = $this->getPdo()->prepare(
        "DELETE FROM `" . $this->tableName . "` WHERE idPatient = :idPatient AND idPraticien = :idPraticien"
    );
    $stmt->execute([
        ':idPatient' => $idPatient,
        ':idPraticien' => $idPraticien
    ]);

    return $stmt->rowCount() > 0; // Renvoie true si suppression réussie
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