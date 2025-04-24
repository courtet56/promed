<?php
namespace Controleur;

use modele\DAO\PatientDAO as PatientModel;
use modele\DAO\PraticienDAO as PraticienModel;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;

Class Validation
{
	public function __construct() {
		/**
		 *	--------------
		 *	    MODELE
		 *	--------------
		 */

		/**
		 *	MODELE : Instance de PatientDAO
		 */

        $captchaUser = strtolower(trim($_POST['captcha']));
        $captchaSession = $_SESSION['captchaCode'] ?? '';
         
        if (md5($captchaUser) !== $captchaSession) {
            $_SESSION['erreur'] = "Le code captcha est incorrect.";
            header("Location: acces"); // ou autre page
            exit();
        }

		$dbPatient = new PatientModel();
        $dbPraticien = new PraticienModel();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim(req::post('email'));
            $motDePasse = trim(req::post('motDePasse'));
            $utilisateur = req::post('choixUtilisateur');

            if (empty($email) || empty($motDePasse)) {
                // TODO retourner message d'erreur
                $_SESSION['erreur'] = "Aucun champ ne doit être vide.";
                header("Location: acces"); // Recharge la page avec l'erreur
                exit();
        
            } elseif ($utilisateur === 'patient') {
                $patient = $dbPatient->getPatientByEmail($email);

                if (isset($patient) && password_verify($motDePasse, $patient['motDePasse'])) {
                    unset($_SESSION['erreur']); // Supprime l'erreur si la connexion est réussie
                    $_SESSION['utilisateur'] = 'patient';
                    header("Location: patient/dashboard");
                    exit();
                } else {
                    // TODO retourner message d'erreur : identifiant ou mot de passe invalide
                    $_SESSION['erreur'] = "Identifiant ou mot de passe invalide.";
                    header("Location: acces"); // Recharge la page avec l'erreur
                    exit();
                }
            } elseif ($utilisateur === 'praticien') {
                $praticien = $dbPraticien->getPraticienByEmail($email);

                if (isset($praticien) && password_verify($motDePasse, $praticien['motDePasse'])) {
                    unset($_SESSION['erreur']); // Supprime l'erreur si la connexion est réussie
                    $_SESSION['utilisateur'] = 'praticien';
                    header("Location: praticien/dashboard");
                    exit();
                } else {
                    // TODO retourner message d'erreur : identifiant ou mot de passe invalide
                    $_SESSION['erreur'] = "Identifiant ou mot de passe invalide.";
                    header("Location: acces"); // Recharge la page avec l'erreur
                    exit();
                }
            }
        }
    }		
}