<?php   

namespace modele;

use app\util\Error;
use modele\DAO\StatutRdvDAO;

class StatutRdv {
    private int $id=0; //La clé primaire est identifiée par $idStatutRdv
    // les autres paramètres sont ci-dessous, dans le constructeur...

    //Constructeur : StatutRdv
    //Le nom des propriétés/attributs/colonnes de la table doivent être identiques dans la déclaration du constructeur.
    //Ne doit pas être ajouté : la clé primaire, car auto-incrémentée :
    public function __construct(
        private string $libelle='',
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
    // CREATE
    public function addStatutRdv(): bool {
        $statutRdvDAO = new StatutRdvDAO();
        return $statutRdvDAO->create($this);
    }

    /**
     * Getters
     */
    public function getIdStatutRdv(): int {
        return $this->id;
    }
    public function getLibelle(): string {
        return $this->libelle;
    }
    /**
     * Setters
     */
    public function setIdStatutRdv(int $idStatutRdv): void {
        $this->id = $idStatutRdv;
    }
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }
}   

// Fin de la classe StatutRdv

?>