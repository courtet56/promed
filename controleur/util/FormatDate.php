<?php
namespace controleur\util;
use DateTime;
use IntlDateFormatter;

class FormatDate{

public static function getFormatDate():string{

// ⚙️ Définir le fuseau horaire
date_default_timezone_set('Europe/Paris');

// 📅 Création d'un objet DateTime pour la date actuelle
$date = new DateTime();

// 🌍 Création d'un formateur personnalisé
$formatter = new IntlDateFormatter(
    'fr_FR', // Langue française
    IntlDateFormatter::FULL, // Format complet pour avoir le jour de la semaine en toutes lettres
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    'EEEE d MMMM yyyy H\'h\'mm' // Format personnalisé
);

// 🌟 Affichage de la date formatée
return ucfirst($formatter->format($date)); 


}
}