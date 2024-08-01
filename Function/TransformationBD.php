<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
include_once '../Function/FunctionClasse.php';
include_once '../Function/FunctionSalle.php';
include_once '../Function/FunctionHoraire.php';
include_once '../Function/FunctionUe.php';
include_once '../Function/FunctionEnseignant.php';
include_once '../Function/FunctionSemaine.php';
include_once '../Function/FunctionProgrammation.php';

//concernant les classes
$Classes = getclasse();
$Tabclasses = CreerTableauObjetclasse($Classes);

//concernant les horaires
$horaires = gethoraire();
$TabHoraires = CreerTableauObjetHoraire($horaires);

//concernant les unites d'enseignement
$ues = getUe();
$TabUes = CreerTableauObjetue($ues);

//concernant les salles
$salles = getsalle();
$Tabsalles = CreerTableauObjetSalle($salles);

//concernant les Enseignants
$enseignants = getEnseignants();
$Tabenseignants = CreerTableauObjetenseignant($enseignants);

//concernant les semaines
$semaines=getSemaine();
$Tabsemaines=CreerTableauObjetSemaine($semaines);

//concernant les programmations
$programmations=getProgrammation();
$TabProgrammations=CreerTableauObjetprogrammer($programmations);

