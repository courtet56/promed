<?php
namespace controleur\util;

use DateTime;

class FormatDate {

    public static function getFormatDate(): string {

        // ⚙️ Définir le fuseau horaire
        date_default_timezone_set('Europe/Paris');

        // 📅 Obtenir la date actuelle
        $date = new DateTime();

        // 🗓️ Tableaux pour traduction des jours et mois
        $jours = [
            'Sunday' => 'Dimanche', 'Monday' => 'Lundi', 'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi', 'Saturday' => 'Samedi'
        ];

        $mois = [
            'January' => 'janvier', 'February' => 'février', 'March' => 'mars',
            'April' => 'avril', 'May' => 'mai', 'June' => 'juin',
            'July' => 'juillet', 'August' => 'août', 'September' => 'septembre',
            'October' => 'octobre', 'November' => 'novembre', 'December' => 'décembre'
        ];

        // 🧩 Construction manuelle de la date
        $jourEn = $date->format('l');
        $jour = $jours[$jourEn];
        $numeroJour = $date->format('j');
        $moisEn = $date->format('F');
        $moisFr = $mois[$moisEn];
        $annee = $date->format('Y');
        $heure = $date->format('H\hi');

        // 📅 Format final : Lundi 6 mai 2024 14h 05
        return "$jour $numeroJour $moisFr $annee $heure";
    }
}