<?php

//inclusion des fichiers
include_once 'Programmation.php';
include_once '../Function/FunctionEnseignant.php';
include_once '../Function/FunctionProgrammation.php';

//Verification des donnee du forumulaire
$Idsemaine = filter_input(INPUT_POST, 'semaineSelect', FILTER_SANITIZE_NUMBER_INT);
$Idhoraire = filter_input(INPUT_POST, 'horaireSelect', FILTER_SANITIZE_NUMBER_INT);
$Idclasse = filter_input(INPUT_POST, 'classSelect', FILTER_SANITIZE_NUMBER_INT);
$Idue = filter_input(INPUT_POST, 'ueSelect', FILTER_SANITIZE_NUMBER_INT);
$IdSalle = filter_input(INPUT_POST, 'salleSelect', FILTER_SANITIZE_NUMBER_INT);
$IdEnseig = filter_input(INPUT_POST, 'enseigSelect', FILTER_SANITIZE_NUMBER_INT);

if (!isset($Idsemaine) || !isset($Idhoraire) || !isset($Idclasse) || !isset($Idue) || !isset($IdSalle) || !isset($IdEnseig)) {
    echo 'Il faut bien renseigner le formulaire pour enregistrer la requete';
    return;
} else {

    //Creation d'un objet(programmation) avec les elements venant du formulaire
    $Prog = new Programmation($IdEnseig, $Idue, $IdSalle, $Idhoraire, $Idsemaine, $Idclasse);
    SaveProgrammation($Prog);
    //include_once '../Programmation/Programmer.php';
}