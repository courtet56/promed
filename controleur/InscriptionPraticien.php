<?php

namespace controleur;

use app\util\Request as req;
use modele\DAO\PraticienDAO as Model;
use vue\base\MainTemplate as Vue;

class InscriptionPraticien
{
    public function __construct()
    {

        /**
         *	--------------
         *	    MODELE
         *	--------------
         */
        /**
         *	MODELE : Instance de PraticienDAO
         */
        $db = new Model();
        
        if(isset($_POST['nom'])){
            echo true;
            exit;
        }
        Vue::addJS([ASSET . '/js/inscription.js',]);
        
        Vue::setTitle('Inscription Praticien');
        Vue::render('InscriptionPraticien',);
        
        
        


    }   

}