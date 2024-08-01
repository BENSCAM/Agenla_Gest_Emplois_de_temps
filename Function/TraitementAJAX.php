<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Function/TransformationBD.php';
include_once '../UniteEnseignement/Ue.php';

$valeurSelectionnee = $_POST['valeur'];

$resultat = [];
//var_dump($TabUes);
foreach ($TabUes as $objet) {
   
    if ($objet->getIdClasse() == $valeurSelectionnee) {
     //   echo 'trouver';
        array_push($resultat, $objet);
    } 
}
echo '<option value="" selected disabled hidden>Choisissez l\'UE</option>';

foreach ($resultat as $value) {
    echo '<option value="'.$value->getIdUe().'">'.$value->getLibelleUe().'</option>';
}


