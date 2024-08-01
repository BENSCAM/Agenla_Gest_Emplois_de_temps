<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';

function getchefdepartement() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM utilsateur   ";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $users = $result->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}