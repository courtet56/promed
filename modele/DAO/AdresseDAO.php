<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Adresse;
use PDO;

class AdresseDAO extends Database {

/** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

    public function __construct() {

        $tableName = 'Adresse';
        $primaryKey = 'idAdresse';

        parent::__construct($tableName, $primaryKey);

    }

    /** 
*	Besoins en données issues du métier Adresse (modele/Adresse.php)
	*	@param object:metier Instance de l'objet métier
	*	@return array
	*/
	private function getAllData($metier): array {
		return [
			'numero' => $metier->getNumero(),
			'rue' => $metier->getRue(),
			'codePostal' => $metier->getCodePostal(),
			'ville' => $metier->getVille(),
			'pays' => $metier->getPays(),
		];
	}
    
	/**
	* CRUD : create
	* @param object:metier Instance de l'objet métier
	* @return bool
	*/
	public function create($metier): bool {

		$data = $this->getAllData($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
		$bool = $this->createOne($data);
		$metier->setIdAdresse( $this->getLastKey() );
		return $bool;
	}

	/**
	* CRUD : read
	* @param integer Numéro de la clé primaire
	* @return mixed object|string|bool
	*/
	
	public function read(int $idAdresse=0): mixed {
		$row = false;
		if($idAdresse>0) {
			$row = $this->getOne($idAdresse); // on récupère la ligne/tuple concernée
		}
		if(!$row){
			die(__class__ . "->read() : Erreur : l'index fourni (<b>$idAdresse</b>) est invalide !" );
		}
		$rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey],$row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new Adresse(...$rowData); //crée l'objet Adresse(->Adresse.php) avec toutes les clés du tableau $rowData
		$metier->setIdAdresse($idAdresse); //ajoute $id dans l'objet métier (Adresse)
		return $metier; //retourne l'objet crée
	}
	
	/**
	* CRUD : update
	* @param object:metier Instance de l'objet métier
	* @return bool
	*/
	public function update($metier): bool {
		$data = $this->getAllData($metier);
		return $this->updateOne($metier->getIdAdresse(),$data);
	}
	
	/**
	* CRUD : delete
	* @param integer Numéro de la clé primaire
	* @return bool
	*/
	public function delete(int $idAdresse=0): bool {
		return $this->deleteOne($idAdresse);
	}

	
}
