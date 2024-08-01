<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../UniteEnseignement/Ue.php';

function getUe() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM unite_ensignement";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $ues = $result->fetchAll(PDO::FETCH_ASSOC);

    return $ues;
}

function CreerTableauObjetue($ues) {
    $LesUes = Ue::arrayToObjet($ues);
    return $LesUes;
}

function afficherUe($ues) {
    $html = "";
    // Parcourir chaque classe
    foreach ($ues as $ue) {

        $html .= '<option value="' . $ue->getIdUe() . '">';
        $html .= $ue->getLibelleUe();
        $html .= '</option>';
    }
    $html .= '</select>'; // Fin du tableau
    return $html;
}
