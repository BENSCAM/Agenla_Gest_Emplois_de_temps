<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Horaire
 *
 * @author BenoitHarck
 */
class Horaire {

    //put your code here
    private $IdHoraire;
    private $Plage;
    private $jour;

    public function __construct($Plage, $jour) {
        $this->Plage = $Plage;
        $this->jour=$jour;
    }

    public function getJour() {
        return $this->jour;
    }

    public function setJour($jour): void {
        $this->jour = $jour;
    }

    public function getIdHoraire() {
        return $this->IdHoraire;
    }

    public function getPlage() {
        return $this->Plage;
    }

    public function setPlage($Plage): void {
        $this->Plage = $Plage;
    }

    static public function arrayToObjet($tableau) {
        $result = [];
        foreach ($tableau as $horaire) {
            $h = new Horaire($horaire['PLAGE'],$horaire['JOUR']);
            $h->IdHoraire = $horaire['ID_HORAIRE'];
            array_push($result, $h);
        }

        return $result;
    }

}
