<?php

namespace controleur;

use app\util\Request as req;
use modele\Praticien as Praticien;
use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\AdresseDAO as AdresseDAO;
use vue\base\MainTemplate as Vue;
use modele\Adresse as Adresse;
use modele\DAO\base\Database as Database;

class InscriptionPraticien
{
    public function __construct()
    {

        /**
         *	--------------
         *	    MODELE
         *	--------------
         */
        
        $praticienDAO = new PraticienDAO();
        $adresseDAO = new AdresseDAO();
    
        if(!empty($_POST)){
       
        $nom = trim(req::post('nom'));
        $prenom = trim(req::post('prenom'));
        $email = trim(req::post('email'));
        $adeli = trim(req::post('adeli'));
        $activite = trim(req::post('activite'));
        $numero = trim(req::post('numero'));
        $rue = trim(req::post('rue'));
        $codePostal = trim(req::post('codePostal'));
        $ville = trim(req::post('ville'));
        $pays = trim(req::post('pays'));
        $motDePasse = password_hash(trim(req::post('motDePasse')), PASSWORD_DEFAULT);
        
        
        $praticien = $praticienDAO->getPraticienByEmail($email);
            if(!empty($praticien)){
                // TODO retourner message d'erreur : email déjà utilisé
                echo false;
                exit;
            } else {
                $adresse = new Adresse($numero, $rue, $codePostal, $ville, $pays);
                if($adresseDAO->create($adresse)){
                    $idAdresse = $adresseDAO->getLastKey();
                    if($idAdresse >0){
                        $praticien = new Praticien($nom, $prenom, $email, $activite, $adeli, $motDePasse, $idAdresse);
                        if($praticienDAO->create($praticien)){
                            // TODO rediriger vers la page de connexion
                            echo true ;
                            var_dump("Inscription praticien réussie !");
                        } else {
                            // TODO retourner message d'erreur : échec de l'inscription
                            var_dump("Inscription praticien échouée !");
                        }
                    } else {
                        var_dump("impossible de réucpérer l'id de l'adresse !");
                    }
                    
                    
                } else {
                    // TODO retourner message d'erreur : échec de l'inscription
                    var_dump("Création Adresse échouée ! Inscription échouée !");
                }

                die;
                
            }
        } else {
            var_dump("Champ vide");
        }
        

        Vue::addJS([ASSET . '/js/inscription.js',]);
        Vue::setTitle('Inscription Praticien');
        Vue::render('InscriptionPraticien',);
        
        
        


    }   

}