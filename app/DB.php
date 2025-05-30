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

 const DB_SERVER = 'localhost'; //127.0.0.1 PAR DEFAUT EN LOCAL
 // distant : localhost
// en local = 'db' 

 const DB_DATABASE = 'promo25_coleen_promed'; //NOM DE LA BDD
 // distant : promo25_coleen_promed
// local = 'promed'
 const DB_USER = 'promo25'; //NOM DE L'UTILISATEUR MYSQL
 // distant = 'promo25'
 // local : 'root'
 const DB_PASSWORD = 'user@sio25'; //MOT DE PASSE
 // distant =  'user@sio25'
 // 'secret'
 const DB_PORT = '3306'; //3306, PORT PAR DEFAUT
 const DB_DEBUG = false; //RENFORCE LE TRAITEMENT DES ERREURS SQL

return [
    'DB_USER' => DB_USER,
    'DB_PASSWORD' => DB_PASSWORD,
    'DB_DSN' => 'mysql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE . ';charset=utf8',
    'DB_DEBUG' => DB_DEBUG
];
?>