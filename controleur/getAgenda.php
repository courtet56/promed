<?php
namespace Controleur;

use modele\DAO\PraticienDAO as Model;
use app\util\Request as req;
use vue\base\MainTemplate as Vue;
use controleur\util\FormatDate as FormatDate;

class getAgenda
{
    public function __construct()
    {

        $db = new Model();

        $_SESSION['prenom'] = 'bernard';
        $_SESSION['nom'] = 'cazeneuve';
        $_SESSION['activite'] = 'Medecin Généraliste';
        $_SESSION['email'] = 'bernard.cazeneuve@example.com';
        $email = $_SESSION['email'];
        $data = $db->getAgendaPraticien($email);
        $dateDuJour = FormatDate::getFormatDate();


        Vue::render('Agenda', [

            'data' => $data,
            'dateDuJour' => $dateDuJour,

            'nom' => $_SESSION['nom'],
            'prenom' => $_SESSION['prenom'],
            'activite' => $_SESSION['activite']


        ]);
    }
}