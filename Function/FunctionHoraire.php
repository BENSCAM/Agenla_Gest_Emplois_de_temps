<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../Horaire/Horaire.php';

function gethoraire() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM plage_horaire";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $horaires = $result->fetchAll(PDO::FETCH_ASSOC);

    return $horaires;
}

function CreerTableauObjetHoraire($horaires) {
    $LesHoraires = Horaire::arrayToObjet($horaires);
    return $LesHoraires;
}

function afficherHoraire($horaires) {
   
    $html = '';
    $html .= ''; // Option vide
    // Parcourir chaque classe
    foreach ($horaires as $horaire) {
        $html .= '<option value="' . $horaire->getIdHoraire() . '">';
        $html .= $horaire->getPlage().'~~'.$horaire->getJour();
        $html .= '</option>';
    }
    $html .= '</select>'; // Fin du tableau
    return $html;
}