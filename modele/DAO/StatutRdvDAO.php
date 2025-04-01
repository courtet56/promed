<?php

namespace modele\DAO;

use modele\DAO\base\Database;
use modele\StatutRdv;
use PDO;

/**
 * StatutRdv DAO
 */

 class StatutRdvDAO extends Database
 {   
    /** 
     * 	Deux paramètres pour le constructeur du DAO :
     *     *	1/ nom de la table
     *    *	2/ nom de la clé primaire
     * *	Voir les méthodes du CRUD dans le DAO (modele/DAO/base/Database.php).
     */

    public function __construct() {

        $tableName = 'StatutRdv';
        $primaryKey = 'idStatutRdv';

        parent::__construct($tableName, $primaryKey);
    }
    /** 
     *	Besoins en données issues du métier StatutRdv (modele/StatutRdv.php)
        *	@param object:metier Instance de l'objet métier
        *	@return array
        */
    private function getAllData($metier): array {
        return [
            'libelle' => $metier->getLibelle(),
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
        $metier->setIdStatutRdv($this->getLastKey());
        return $bool;
    }
    /**
     * CRUD : read
     * @param integer Numéro de la clé primaire
     * @return mixed object|string|bool
     */
    public function read(int $idStatutRdv=0): mixed {
        $row = false;
        if ($idStatutRdv > 0) {
            $row = $this->getOne($idStatutRdv); // on récupère la ligne/tuple concernée
        }
        //gestion de l'index en cas d'erreur :
        if (!$row) {
            die(__CLASS__ . "->read() : l'index fourni (<b>$idStatutRdv</b>) est invalide !" );
        }
        $rowData = (array)$row; //conversion objet --> array
        unset($rowData[$this->primaryKey], $row); //retire la clé primaire du tableau et $row qui ne sert plus
        $metier = new StatutRdv(...$rowData); //crée l'objet StatutRdv(->StatutRdv.php) avec toutes les clés du tableau $rowData
        $metier->setIdStatutRdv($idStatutRdv); //ajoute $id dans l'objet métier (StatutRdv)
        return $metier; //retourne l'objet crée
    }
    /**
     * CRUD : update
     * @param object:metier Instance de l'objet métier
     * @return bool
     */
    public function update($metier): bool {
        $data = $this->getAllData($metier);
        //updateOne() et getLastKey() sont des méthodes du DAO (modele/DAO/base/Database.php)
        $bool = $this->updateOne($data, $metier->getIdStatutRdv());
        return $bool;
    }
    /**
     * CRUD : delete
     * @param integer Numéro de la clé primaire
     * @return bool
     */
    public function delete(int $idStatutRdv=0): bool {
        $bool = false;
        if ($idStatutRdv > 0) {
            $bool = $this->deleteOne($idStatutRdv);
        }
        return $bool;
    }
 }
  