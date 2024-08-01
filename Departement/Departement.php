<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Departement
 *
 * @author BenoitHarck
 */
class Departement {

    private $iddepartement;
    private $codedepartement;
    private $libelledepartement;

    public function __construct($codedepartement, $libelledepartement) {
        $this->codedepartement = $codedepartement;
        $this->libelledepartement = $libelledepartement;
    }

    public function getIddepartement() {
        return $this->iddepartement;
    }

    public function getCodedepartement() {
        return $this->codedepartement;
    }

    public function getLibelledepartement() {
        return $this->libelledepartement;
    }

    public function setCodedepartement($codedepartement): void {
        $this->codedepartement = $codedepartement;
    }

    public function setLibelledepartement($libelledepartement): void {
        $this->libelledepartement = $libelledepartement;
    }

    static public function arrayToObjet($tableau) {
        $result = [];
        foreach ($tableau as $departement) {
            $D = new Departement($departement['CODE_DEPART'], $departement['LIBELLE_DEPART']);
            $D->iddepartement = $departement['ID_DEPARTEMENT'];
            array_push($result, $D);
        }

        return $result;
    }

}
