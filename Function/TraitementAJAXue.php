<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Function/FunctionEnseignant.php';
include_once '../UniteEnseignement/Ue.php';

$valeurSelectionnee = $_POST['valeur'];

$var = getEnseigByUe($valeurSelectionnee);

echo '<option value="" selected disabled hidden>Choisissez l\'Enseignant</option>';

foreach ($var as $value) {
    echo '<option value="' . $value['ID_ENSEIGNANT'] . '">' . $value['NOM_ENSEIGNANT'] . " " . $value['PRENOM_ENSEIGNANT'] . '</option>';
}