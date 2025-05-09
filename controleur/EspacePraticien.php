<?php

namespace controleur;

use modele\Praticien as Praticien;
use modele\DAO\PraticienDAO as PraticienDAO;
use vue\base\MainTemplate as Vue;
use modele\Adresse as Address;
use modele\DAO\AdresseDAO as AdresseDAO;





class EspacePraticien{

    public function __construct(){


        // Utilisation de GET pour orienter vers la bonne fonctionnalité (ex: GET = modif_profil))
        // renvoie la vue en conséquence

        $praticienDAO = new PraticienDAO();
        $praticien = $praticienDAO->read(17);
        echo '<pre>';
        print_r($praticien);
        echo '</pre>';

        $adresseDAO = new AdresseDAO();
        $adresse = $adresseDAO->read(17);
        echo '<pre>';
        print_r($adresse);
        echo '</pre>';
        


        if($_GET['action'] == 'modif_profil'){
            echo 'test';
            
            if($praticien){
                $dataPrat = array();
                $dataPrat['nom'] = $praticien->getNom();
                $dataPrat['prenom'] = $praticien->getPrenom();
                $dataPrat['email'] = $praticien->getEmail();
                $dataPrat['activite'] = $praticien->getActivite();
                $dataPrat['adeli'] = $praticien->getAdeli();
                $dataPrat['numero'] = $adresse->getNumero();
                $dataPrat['rue'] = $adresse->getRue();
                $dataPrat['codePostal'] = $adresse->getCodePostal();
                $dataPrat['ville'] = $adresse->getVille();
                $dataPrat['pays'] = $adresse->getPays();

                echo '<pre>';
                print_r($dataPrat);
                echo '</pre>';

                

            }

            Vue::addCSS([ASSET . '/css/inscriptionPraticien.css',]);
            Vue::setTitle('Modification profil');
            Vue::addJS([ASSET . '/js/modifParamPraticien.js',]);
            Vue::render('ModifParamPraticien', [
                'dataPrat' => $dataPrat
            ]);
            


        }
            




    }
}