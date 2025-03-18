<?php

/**
 *  *******************
 *  Globales DB configs
 *  *******************
 *
 *	Note: sur Docker utiliser le nom du service utilisé pour la BDD.
 *	Exemple : services: db: ==> const DB_SERVER = 'db';
 *
 */

 const DB_SERVER = 'db'; //127.0.0.1 PAR DEFAUT EN LOCAL 
 const DB_DATABASE = 'promed'; //NOM DE LA BDD
 const DB_USER = 'root'; //NOM DE L'UTILISATEUR MYSQL
 const DB_PASSWORD = 'secret'; //MOT DE PASSE
 const DB_PORT = '3306'; //3306, PORT PAR DEFAUT
 const DB_DEBUG = false; //RENFORCE LE TRAITEMENT DES ERREURS SQL

return [
    'DB_USER' => DB_USER,
    'DB_PASSWORD' => DB_PASSWORD,
    'DB_DSN' => 'mysql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=utf8',
    'DB_DEBUG' => DB_DEBUG
];
?>