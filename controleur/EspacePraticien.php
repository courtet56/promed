<?php

namespace controleur;

use modele\Praticien as Praticien;
use modele\DAO\PraticienDAO as PraticienDAO;
use vue\base\MainTemplate as Vue;
use modele\Adresse as Adresse;
use modele\DAO\AdresseDAO as AdresseDAO;

use controleur\util\FormatDate as FormatDate;

use modele\DAO\ProposeDAO as ProposeDAO;
use modele\Propose as Propose;
use modele\DAO\PrestationDAO as PrestationDAO;





class EspacePraticien{

    public function __construct(){
        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == "praticien") {


        // Utilisation de GET pour orienter vers la bonne fonctionnalité (ex: GET = modif_profil))
        // renvoie la vue en conséquence

        $praticienDAO = new PraticienDAO();
        $praticien = $praticienDAO->read(19);
        // echo '<pre>';
        // print_r($praticien);
        // echo '</pre>';

        $adresseDAO = new AdresseDAO();
        $adresse = $adresseDAO->read(19);
        // echo '<pre>';
        // print_r($adresse);
        // echo '</pre>';

        $proposeDAO = new ProposeDAO();
        $proposes = $proposeDAO->read(19); // retourne tous les proposes du medecin 

        // echo'<pre>';
        // print_r($proposes);
        // echo'<pre>';

        

        
        
        if($_GET['action'] == "agenda"){
            $_SESSION['prenom'] = 'bernard';
            $_SESSION['nom'] = 'cazeneuve';
            $_SESSION['activite'] = 'Medecin Généraliste';
            $_SESSION['email'] = 'bernard.cazeneuve@example.com';
            $email = $_SESSION['email'];
            $data = $praticienDAO->getAgendaPraticien($email);
            $dateDuJour = FormatDate::getFormatDate();


            Vue::render('Agenda', [

                'data' => $data,
                'dateDuJour' => $dateDuJour,

                'nom' => $_SESSION['nom'],
                'prenom' => $_SESSION['prenom'],
                'activite' => $_SESSION['activite']
            ]);
        }

        if($_GET['action'] == 'modif_profil'){
            
            if($praticien){
                $dataPrat = [];
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

                // echo '<pre>';
                // print_r($dataPrat);
                // echo '</pre>';

                $dataPrestations = []; //créé tableau avec tous les objets prestations qui regroupent les attributs de propose + prestation
        
                $prestationDAO = new PrestationDAO;
                foreach ($proposes as $key => $propose){
                    $prestation = $prestationDAO->read($propose->getIdPresta());
                    $dataPrestations[$key]['idPresta'] = $propose->getIdPresta();
                    $dataPrestations[$key]['idPratcien'] = $propose->getIdPraticien();
                    $dataPrestations[$key]['duree'] = $propose->getDuree();
                    $dataPrestations[$key]['tarif'] = $propose->getTarif();
                    $dataPrestations[$key]['libelle'] = $prestation->getLibelle();
                    
                }

                // echo "<pre>";
                // echo"objet propose: ";
                // print_r($propose);
                // echo"<pre>";

                $dataLibellePrestations = $prestationDAO->getAllPrestations(); // recupère toutes les presta disponibles dans la table 
                // echo'<pre>';
                // print_r($dataLibellePrestations);

            }

            Vue::addCSS([ASSET . '/css/modifParamPraticien.css',]);
            Vue::setTitle('Modification profil');
            Vue::addJS([ASSET . '/js/modifParamPraticien.js',]);
            Vue::render('ModifParamPraticien', [
                'dataPrat' => $dataPrat,
                'dataPrestations' => $dataPrestations,
                'dataLibellePrestations' => $dataLibellePrestations
            ]);

        }

        } else {
            echo "Vous n'êtes pas connecté.";
        }
    } 
}