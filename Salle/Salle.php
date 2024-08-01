<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Salle
 *
 * @author BenoitHarck
 */
class Salle {

    //put your code here
    private $IdSalle;
    private $CodeSalle;
    private $Capacite;
    private $Etat;

    public function __construct($CodeSalle, $Capacite, $Etat) {
        $this->CodeSalle = $CodeSalle;
        $this->Capacite = $Capacite;
        $this->Etat = $Etat;
    }

    public function getEtat() {
        return $this->Etat;
    }

    public function setEtat($Etat): void {
        $this->Etat = $Etat;
    }

    public function getIdSalle() {
        return $this->IdSalle;
    }

    public function getCodeSalle() {
        return $this->CodeSalle;
    }

    public function getCapacite() {
        return $this->Capacite;
    }

    public function setCodeSalle($CodeSalle): void {
        $this->CodeSalle = $CodeSalle;
    }

    public function setCapacite($Capacite): void {
        $this->Capacite = $Capacite;
    }

    static public function arrayToObjet($tableau) {
        $result = [];
        foreach ($tableau as $salle) {
            $s = new Salle($salle['CODE_SALLE'], $salle['CAPACITE'], $salle['Etat']);
            $s->IdSalle = $salle['ID_SALLE'];
            array_push($result, $s);
        }

        return $result;
    }

}
