<?php

namespace controleur;

use modele\Praticien as Praticien;
use modele\DAO\PraticienDAO as PraticienDAO;
use vue\base\MainTemplate as Vue;
use modele\Adresse as Adresse;
use modele\DAO\AdresseDAO as AdresseDAO;

use controleur\util\FormatDate as FormatDate;

use modele\DAO\ProposeDAO as ProposeDAO;
use modele\DAO\PrestationDAO as PrestationDAO;
use app\util\Request as Request;
use modele\DAO\SoigneDAO as SoigneDAO;
use modele\RendezVous as RendezVous;
use modele\DAO\RendezVousDAO as RendezVousDAO;






class EspacePraticien{

    public function action($action): bool {
        return Request::is($action);
    }


    public function __construct(){

        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == "praticien") {


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
                
                // Début Ajout Rdv: 
                $idPraticien = $_SESSION['user']['idPraticien'];
                $soigneDAO = new SoigneDAO();
                $soignes = $soigneDAO->getAllPatientsFromPraticien($idPraticien);
                // var_dump($soignes);
                $messageSuccess = '';
                $messageError = '';

                $dataPrestations = []; //créé tableau avec tous les objets prestations qui regroupent les attributs de propose + prestation
            
                $prestationDAO = new PrestationDAO;
                foreach ($proposes as $key => $propose){
                    $prestation = $prestationDAO->read($propose->getIdPresta()); // retourne  l'objet prestation avec un idPresta précis
                    $dataPrestations[$key]['idPresta'] = $propose->getIdPresta();
                    $dataPrestations[$key]['duree'] = $propose->getDuree();
                    $dataPrestations[$key]['tarif'] = $propose->getTarif();
                    $dataPrestations[$key]['libelle'] = $prestation->getLibelle();
                }
                
                $patientId = Request::post('idPatient');
                $idPresta = Request::post('idPrestation');
                $heureRdv = Request::post('heureRdv');
                $dateRdv = Request::post('dateRdv');
                $idStatut = 1; // statut "en cours" par défaut;

                if(Request::post('btnConfirmer') === '1'){
                    echo'test';
                    if(!empty($patientId) 
                    && !empty($idPresta) 
                    && !empty($heureRdv) 
                    && !empty($dateRdv)
                    && !empty($idStatut))
                    {
                        
                        $rdv = new RendezVous($dateRdv, $heureRdv, $patientId, $idPraticien, $idPresta, $idStatut);
                        $rdvDAO = new RendezVousDAO();

                        $isDispo = $rdvDAO->verifierDispo($idPraticien, $idPresta, $dateRdv, $heureRdv);
                        if($isDispo === false){
                            $_SESSION['messageError'] = "Créneau indisponible.";
                            header('Location: ' . $_SERVER['REQUEST_URI']);
                            exit;
                        } else {
                            $result = $rdvDAO->create($rdv);
                            
                            if($result === true){
                                $_SESSION['messageSuccess'] = "Nouveau rendez-vous ajouté avec succès.";
                                header('Location: ' . $_SERVER['REQUEST_URI']);
                                exit;
                            }
                        }
                        
                    }
                } 

                Vue::addCSS([ASSET . '/css/agenda.css',]);
                Vue::addJS([ASSET . '/js/agendaAjoutRdv.js',]);
                Vue::addJS([ASSET . '/js/agenda.js',]);
                Vue::setTitle('Agenda du praticien');
                Vue::render('Agenda', [
                    //Ajout rdv:
                    'arraySoignes' => $soignes, 
                    'dataPrestations' => $dataPrestations,
                    'messageSuccess' => $messageSuccess,
                    'messageError' => $messageError,
                    

                    // Affichage agenda
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