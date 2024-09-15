<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
    include_once '../Database/Database1.php';
    include_once '../Salle/Salle.php';

    function getsalle() {
        $db = new Database1();
        try {
            // Préparez la requête SQL
            $sql = "SELECT * FROM salle";
            $result = $db->executeQuery($sql);
            $result->execute();
            //echo 'Lecture reussie';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        // Récupérez tous les résultats

        $salles = $result->fetchAll(PDO::FETCH_ASSOC);

        return $salles;
    }

function CreerTableauObjetSalle($salles) {
    $LesSalles = Salle::arrayToObjet($salles);
    return $LesSalles;
}

function afficherSalle($LesSalles) {
   
    // Parcourir chaque classe
    foreach ($LesSalles as $classe) {

        $isOccopied= $classe->getEtat();
        $html .= '<option value="' . $classe->getIdSalle() . '"';

        if($isOccopied==1){
            $html .= ' disabled style="color: grey;"'; // Griser et désactiver l'option
        }
        $html .= '>';
        $html .= $classe->getCodeSalle().' ->('. $classe->getCapacite().') places';
        $html .= '</option>';
    }
    $html .= '</select>'; // Fin du tableau
    return $html;
}

