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

         
        
    
    
        Vue::addCSS([ASSET . '/css/inscriptionPraticien.css',]);
        Vue::addJS([ASSET . '/js/inscription.js',]);
        Vue::setTitle('Inscription Praticien');
        Vue::render('InscriptionPraticien',);
        
        
        
        


    }   

}