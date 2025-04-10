<?php

namespace modele;
use app\util\Error;
use modele\DAO\StatutFacturationDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : StatutFacturation
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/StatutFacturationDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "Pyatient".
 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

class StatutFacturation {

	private int $id=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : User
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private string $libelle='') {

		//Gestionnaire d'erreur (pour les requêtes) :
		try {
			Error::checkModelArgs(get_object_vars($this), __CLASS__ , func_get_args());
		} catch (\InvalidArgumentException $e) {
			$err = "Erreur : " . $e->getMessage();
			$err .= Error::print($e->getTrace(), 1);
			exit($err);
		}
	}
	
	/**
	 * Getters
	 */
	
	public function getIdStatutFacturation(): int {
		return $this->id;
	}
	
	public function getLibelle(): string {
		return $this->libelle;
	}
		
	/**
	 * Setters
	 */
	
	public function setIdStatutFacturation(int $idStatutFacturation): void {
		$this->id = $idStatutFacturation;
	}
	
	public function setLibelle(string $libelle): void {
		$this->libelle = $libelle;
	}
	

}
