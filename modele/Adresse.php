<?php

namespace modele;
use app\util\Error;
use modele\DAO\AdresseDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Adresse
 * 

 */

 class Adresse {
    private int $idAdresse=0; //La clé primaire est identifiée par $id
    // les autres paramètres sont ci-dessous, dans le constructeur...

    //Constructeur : Adresse
    //Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
    //Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
    public function __construct(
        private string $numero='',
        private string $rue='',
        private string $codePostal='',
        private string $ville='',
        private string $pays='',
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
    public function addAdresse(): bool {
        $adresseDAO = new AdresseDAO();
        return $adresseDAO->create($this);
    }
    /**
     * Getters
     */
    public function getIdAdresse(): int {
        return $this->idAdresse;
    }
    public function getNumero(): string {
        return $this->numero;
    }
    public function getRue(): string {
        return $this->rue;
    }
    public function getCodePostal(): string {
        return $this->codePostal;
    }
    public function getVille(): string {
        return $this->ville;
    }
    public function getPays(): string {
        return $this->pays;
    }
    /**
     * Setters
     */
    public function setIdAdresse(int $idAdresse): void {
        $this->idAdresse = $idAdresse;
    }
    public function setNumero(string $numero): void {
        $this->numero = $numero;
    }
    public function setRue(string $rue): void {
        $this->rue = $rue;
    }
    public function setCodePostal(string $codePostal): void {
        $this->codePostal = $codePostal;
    }
    public function setVille(string $ville): void {
        $this->ville = $ville;
    }
    public function setPays(string $pays): void {
        $this->pays = $pays;
    }
}   
 
// Fin de la classe Adresse