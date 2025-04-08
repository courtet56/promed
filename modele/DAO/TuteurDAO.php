<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\Tuteur;
use PDO;

/**
 *  Tuteur DAO
 */
class TuteurDAO extends Database
{   
   /** 
	*	Deux paramètres pour le constructeur du DAO :
	*	1/ nom de la table
	*	2/ nom de la clé primaire
	*	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
	*/

    public function __construct() {

        $tableName = 'Tuteur';
        $primaryKey = 'idTuteur';

        parent::__construct($tableName, $primaryKey);
    }

    /** 
	*	Besoins en données issues du métier User (modele/User.php)
	*	@param object:metier Instance de l'objet métier
	*	@return array
	*/
    private function getAlldata($metier) {

        return [
            'nom' => $metier->getNom(),
            'prenom' => $metier->getPrenom(),
            'adresse' => $metier->getAdresse(),
            'telephone' => $metier->getTelephone(),
            'email' => $metier->getEmail(),
            'dateNaiss' => $metier->getDateNaiss(),
        ];
    }

    /**
     * CRUD
     * @param object:metier Instance de l'objet métier
     * @return bool
     */

     public function create($metier): bool {

        $data = $this->getAlldata($metier);
		//createOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
        $bool = $this->createOne($data);
        $metier->setIdTuteur($this->getLastKey());
        return $bool;
    }

    /** 
	*	CRUD : read
	*	@param integer Numéro de la clé primaire
	*	@return mixed object|string|bool
	*/
    public function read(int $idTuteur=0): mixed {
        $row = false;
        if($idTuteur>0) {
            $row = $this->getOne($idTuteur); // on récupère la ligne/tuple concernée
        }
        if(!$row){
            die( __CLASS__ . "->read() : l'index fourni (<b>$idTuteur</b>) est invalide !" );
        }
        
        $rowData = (array)$row; //conversion objet --> array
		unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
		$metier = new Tuteur(...$rowData); //crée l'objet Tuteur(->Tuteur.php) avec toutes les clés du tableau $rowData
		$metier->setIdTuteur($idTuteur); //ajoute $id dans l'objet métier (User)
		return $metier; //retourne l'objet crée
    }

    /** 
	*	CRUD : update
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
    public function update($metier): bool {
        $data = $this->getAlldata($metier);
        //updateOne() est une méthode du DAO (modele/DAO/base/Database.php)
        return $this->updateOne($metier->getIdTuteur(), $data);
    }

    /** 
	*	CRUD : delete
	*	@param object:metier Instance de l'objet métier
	*	@return bool
	*/
	public function delete($metier): bool {
		//deleteOne() est une méthode du DAO (modele/DAO/base/Database.php)
		return $this->deleteOne( $metier->getIdTuteur() );
	}

    /**
	*	Méthode permettant l'accès aux données filtrées pour une recherche du prénom ou du nom, 
	*	avec une requête préparée.
	* 	@param string $name Nom ou prénom du tuteur
	* 	@return array
	*/
	public function getTuteurByName(string $name): mixed {
		$stmt = $this->getPdo()->prepare("SELECT * FROM `" . $this->tableName . "` WHERE prenom LIKE :sname OR nom LIKE :name");
		$stmt->execute([':sname' => "%$name%", ':name' => "%$name%"]);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

    /**
	*	Méthode sendSQL() implémentée dans le DAO (modele/DAO/base/Database.php)
	*	Prend en compte la commande SQL et son filtre issue du prepared statement [?]
	*	Le filtre (ici $name) est obligatoirement un tableau !
	* 	@param string $name Prénom du tuteur
	* 	@return object
	*/
	public function getLineFrom(string $name): \stdClass {
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

}
?>
