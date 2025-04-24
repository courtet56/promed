<?php

namespace modele;
use app\util\Error;
use modele\DAO\TuteurDAO;

/**
 * MODELE : Objet métier : Direct Object (DO) : Tuteur
 * 

 */

class Tuteur {
    private int $id=0; //La clé primaire est identifiée par $idTuteur
    // les autres paramètres sont ci-dessous, dans le constructeur...

    //Constructeur : Tuteur
    //Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
    //Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
    public function __construct(
        private string $nom='',
        private string $prenom='',
        private string $dateNaiss = '', // utilise le type ?DateTime, ce qui signifie qu'elle peut être soit un objet DateTime, soit null (si aucune date n'est définie)
        private string $telephone='',
        private string $email='',
        private int $idAdresse=0) {

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
    public function addTuteur(): bool {
        $tuteurDAO = new TuteurDAO();
        return $tuteurDAO->create($this);
    }

    /**
     * Getters
     */
    public function getIdTuteur(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    // Retourne la date de naissance sous forme de chaîne
    public function getDateNaissance(): string {
        return $this->dateNaiss; // Si la date est définie, retourne au format Y-m-d
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getIdAdresse(): string {
        return $this->idAdresse;
    }

    /**
     * Setters
     */
    public function setIdTuteur($idTuteur): void {
        $this->id = $idTuteur;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }
    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }
    
    public function setDateNaissance($dateNaiss): void {
        $this->dateNaiss = $dateNaiss;
    }

    public function setTelephone($telephone): void {
        $this->telephone = $telephone;
    }
    public function setEmail($email): void {
        $this->email = $email;
    }
    public function setIdAdresse($idAdresse): void {
        $this->idAdresse = $idAdresse;
    }
}   

// Fin de la classe Tuteur


