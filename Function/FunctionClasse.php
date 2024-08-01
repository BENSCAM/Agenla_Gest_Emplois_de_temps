<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../Classe/Classe.php';

function getclasse() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM classe";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $classes = $result->fetchAll(PDO::FETCH_ASSOC);

    return $classes;
}

function CreerTableauObjetclasse($classes) {
    $LesClasses = Classe::arrayToObjet($classes);
    return $LesClasses;
}

function afficherClasses($classes) {

    // Parcourir chaque classe
    foreach ($classes as $classe) {
        $html .= '<option value="' . $classe->getIdClasse() . '">';
        $html .= $classe->getNomClasse() . " " . $classe->getNiveau();
        $html .= '</option>';
    }
    return $html;
}

function AfficherListeClasse($LesClasses) {

    $html = "";

    foreach ($LesClasses as $classe) {
        $html .= '<li>';
        $html .= '<a href="../Departement/DepartementIGL?id='.$classe->getIdClasse().'" data-valeur='.$classe->getIdClasse().'>'.$classe->getNomClasse().$classe->getNiveau().'</a>';
        $html .= '</li>';
    }
    
    return $html;
}
