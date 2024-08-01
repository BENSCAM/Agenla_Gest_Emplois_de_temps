<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../Departement/Departement.php';

function getdepartement() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM departement";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $departements = $result->fetchAll(PDO::FETCH_ASSOC);

    return $departements;
}

function CreerTableauObjetdepartement($departements) {
    $lesdepartements = Departement::arrayToObjet($departements);
    return $lesdepartements;
}

function afficherdepartement($departements) {
   
    $html = '<select name="departement" class="combobox">';
    $html .= '<option value="" selected disabled hidden>Affecter a un departement</option>'; // Option vide
    // Parcourir chaque classe
    foreach ($departements as $departement) {
        $html .= '<option value="' . $departement->getIddepartement() . '">';
        $html .= $departement->getLibelledepartement();
        $html .= '</option>';
    }
    $html .= '</select>'; // Fin du tableau
    return $html;
}