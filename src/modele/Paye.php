<?php

namespace modele;
use app\util\Error;
use modele\DAO\PayeDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : User
 * Encapsulation, manipulation et récupération des données issues du DAO :
 * -> modele/DAO/UserDAO.php (hérités de : modele/DAO/base/Database.php)
 * Accesseurs / mutateurs de la table : "clients".
 * Logique métier à implémenter, par exemple : 
 * calculer l'âge à partir de la date de naissance dans une méthode getAge() ...
 */

class Paye {

	private int $id=0; //La clé primaire est identifiée par $id
	// les autres paramètres sont ci-dessous, dans le constructeur...
	
	//Constructeur : User
	//Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
	//Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
	public function __construct( 
		private int $idFacturation=0,
		private int $idTypePaiement=0,
		private float $montant=0
        ) {

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
	 * Methods
	 */		
	
	// // CREATE
	// public function addUser(): bool {
	// 	$userDAO = new UserDAO();
	// 	return $userDAO->create($this);
	// }

	// // Vérification de l'email
	// public function isValidEmail(): bool {
	// 	return filter_var($this->email, FILTER_VALIDATE_EMAIL);
	// }
	
	/**
	 * Getters
	 */
	
	public function getIdFacturation(): int {
		return $this->idFacturation;
	}
	
	public function getIdTypePaiement(): string {
		return $this->idTypePaiement;
	}
	
	public function getMontant(): string	{
		return $this->montant;
	}
	
	
	/**
	 * Setters
	 */
	
	public function setIdFacturation($idFacturation): void {
		$this->idFacturation = $idFacturation;
	}
	
	public function setIdTypePaiement($idTypePaiement): void {
		$this->idTypePaiement = $idTypePaiement;
	}
	
	public function setMontant($montant): void {
		$this->montant = $montant;
	}
}