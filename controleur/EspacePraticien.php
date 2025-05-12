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
use app\util\Request as Request;





class EspacePraticien{

    public function action($action): bool {
        return Request::is($action);
    }


    public function __construct(){

        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == "praticien") {


            // Utilisation de GET pour orienter vers la bonne fonctionnalité (ex: GET = modif_profil))
            // renvoie la vue en conséquence

            $praticienDAO = new PraticienDAO();
            $praticienArray = $praticienDAO->getPraticienByEmail($_SESSION['user']['email']);
            $praticien = Praticien::fromArray($praticienArray);
            $praticien->setId($praticienArray['id']);

            // echo '<pre>';
            // print_r($praticien);
            // echo '</pre>';

            $adresseDAO = new AdresseDAO();
            $adresse = $adresseDAO->read($praticien->getIdAdresse());

            $proposeDAO = new ProposeDAO();
            $proposes = $proposeDAO->read($praticien->getId()); // retourne tous les proposes du medecin 

            // echo'<pre>';
            // print_r($proposes);
            // echo'<pre>';        
            
            if($this->action("agenda")){
                $data = $praticienDAO->getAgendaPraticien($praticien->getEmail());
                $dateDuJour = FormatDate::getFormatDate();

                Vue::addCSS([ASSET . '/css/agenda.css',]);
                Vue::setTitle('Agenda du praticien');
                Vue::render('Agenda', [

                    'data' => $data,
                    'dateDuJour' => $dateDuJour,
                    'praticien' => $praticien
                ]);
            }

            if($this->action("modif_profil")){
                
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
                    'dataLibellePrestations' => $dataLibellePrestations,
                    'praticien' => $praticien
                ]);

            }

            if($this->action("accueil_praticien")){
                // print_r($praticien);
                Vue::render('AccueilPraticien', [
                    "praticien" => $praticien
                ]);
            }

        } else {
            echo "Vous n'êtes pas connecté.";
        }
    } 
}