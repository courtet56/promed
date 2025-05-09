<?php

namespace controleur;

use modele\DAO\PraticienDAO as PraticienDAO;
use modele\DAO\PatientDAO as PatientDAO;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;

Class Authentif
{
	public function __construct() {
    
		/**
		 *	--------------
		 *	    MODELE
		 *	--------------
		 */

		/**
		 *	MODELE : Instance de PraticienDAO
		 */
		// $db = new PraticienDAO();

        // $email = trim(req::post('email'));
        // $motDePasse = trim(req::post('motDePasse'));

        // if (empty($email) || empty($motDePasse)) {
        //     // TODO retourner message d'erreur
        //     var_dump("Champ vide");
        // } else {

        //     $praticien = $db->getPraticienByEmail($email);

        //     if (isset($praticien) && password_verify($motDePasse, $praticien['motDePasse'])) {
        //         // TODO se connecter à l'espace Praticien
        //          // Connexion réussie
        // $_SESSION['IdPraticien'] = $praticien['idPraticien'];
        // $_SESSION['nom'] = $praticien['nom'];
        // $_SESSION['prenom'] = $praticien['prenom'];
        // header('Location: espace_praticien.php');
        
        //         // TODO mettre en place la session Praticien
        //         var_dump("Connexion OK");
        //     } else {
        //         // TODO retourner message d'erreur : identifiant ou mot de passe invalide
        //         var_dump("Champ invalide");
        //     }

        // }
        Vue::addCSS([
			ASSET . '/css/accueil.css',
		]);
        Vue::addJS([ASSET . '/js/authentif.js',]);

        Vue::setTitle('Authentification');
        Vue::render('Auth');
    }

    public static function validation() {
        session_start();


        $captchaUser = strtolower(trim($_POST['captcha']));
         $captchaSession = $_SESSION['captchaCode'] ?? '';
          
         if (md5($captchaUser) !== $captchaSession) {
             $_SESSION['erreur'] = "Le code captcha est invalide";
             header("Location: ."); // ou autre page
             exit();
         }
 
         $dbPatient = new PatientDAO();
         $dbPraticien = new PraticienDAO();
 
         if (isset($_POST['email']) &&  isset($_POST['motDePasse']) ) {
             $email = trim(req::post('email'));
             $motDePasse = trim(req::post('motDePasse'));
             $utilisateur = req::post('choixUtilisateur');
 
             if (empty($email) || empty($motDePasse)) {
                 $_SESSION['erreur'] = "Aucun champ ne doit être vide.";
                 header("Location: auth"); // Recharge la page avec l'erreur
                 exit();
         
             } elseif ($utilisateur === 'patient') {
                 $patient = $dbPatient->getPatientByEmail($email);
 
                 if (isset($patient) && password_verify($motDePasse, $patient['motDePasse'])) {
                     unset($_SESSION['erreur']); // Supprime l'erreur si la connexion est réussie
                     $_SESSION['patient'] = $patient;
                     header("Location: patient/dashboard");
                     exit();
                 } else {
                     $_SESSION['erreur'] = "Identifiant ou mot de passe invalide.";
                     header("Location: auth"); // Recharge la page avec l'erreur
                     exit();
                 }
             } elseif ($utilisateur === 'praticien') {
                 $praticien = $dbPraticien->getPraticienByEmail($email);
 
                 if (isset($praticien) && password_verify($motDePasse, $praticien['motDePasse'])) {
                     unset($_SESSION['erreur']); // Supprime l'erreur si la connexion est réussie
                     $_SESSION['praticien'] = $praticien;
                     header("Location: praticien/dashboard");
                     exit();
                 } else {
                     $_SESSION['erreur'] = "Identifiant ou mot de passe invalide.";
                     header("Location: auth"); // Recharge la page avec l'erreur
                     exit();
                 }
             }
         }
    }		
}