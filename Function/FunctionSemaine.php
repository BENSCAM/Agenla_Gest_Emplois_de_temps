<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../Semaine/Semaine.php';

function getSemaine() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM semaine";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $semaines = $result->fetchAll(PDO::FETCH_ASSOC);

    return $semaines;
}

function CreerTableauObjetSemaine($semaines) {
    $LesSemaines = Semaine::arrayToObjet($semaines);
    return $LesSemaines;
}

function afficherSemaine($LesSemaines) {
   
    $html = '';
    $html .= ''; // Option vide
    // Parcourir chaque classe
    foreach ($LesSemaines as $semaine) {
        $html .= '<option value="' . $semaine->getIdsemaine() . '">';
        $html .= $semaine->getNumsemaine();
        $html .= '</option>';
    }
    $html .= '</select>'; // Fin du tableau
    return $html;   
}

function AfficherListeSemaine($LesSemaines) {

    $html = "";

    foreach ($LesSemaines as $semaine) {
        $html .= '<li>';
        $html .= '<a href="#?idsemaine='.$semaine->getIdsemaine().'">'.$semaine->getNumsemaine().'</a>';
        $html .= '</li>';
    }
    
    return $html;
}
