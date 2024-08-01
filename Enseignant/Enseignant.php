<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Enseignant
 *
 * @author BenoitHarck
 */
class Enseignant {

    private $idenseignant;
    private $nomenseignant;
    private $emailenseignant;
    private $prenomenseignant;
    private $telenseignant;
    

    public function __construct($nomenseignant = null, $emailenseignant = null, $prenomenseignant = null, $telenseignant = null) {
        $this->idenseignant = 0;
        $this->nomenseignant = $nomenseignant;
        $this->emailenseignant = $emailenseignant;
        $this->prenomenseignant = $prenomenseignant;
        $this->telenseignant = $telenseignant;
        
    }

    public function MemoryUpdate($id, $nomenseignant, $emailenseignant, $prenomenseignant, $telenseignant) {
        $this->nomenseignant = $nomenseignant;
        $this->emailenseignant = $emailenseignant;
        $this->prenomenseignant = $prenomenseignant;
        $this->telenseignant = $telenseignant;
        $this->idenseignant = $id;
    }

    public function getIdenseignant() {
        return $this->idenseignant;
    }

    public function getNomenseignant() {
        return $this->nomenseignant;
    }

    public function getEmailenseignant() {
        return $this->emailenseignant;
    }

    public function getPrenomenseignant() {
        return $this->prenomenseignant;
    }

    public function getTelenseignant() {
        return $this->telenseignant;
    }

    public function setNomenseignant($nomenseignant): void {
        $this->nomenseignant = $nomenseignant;
    }

    public function setEmailenseignant($emailenseignant): void {
        $this->emailenseignant = $emailenseignant;
    }

    public function setPrenomenseignant($prenomenseignant): void {
        $this->prenomenseignant = $prenomenseignant;
    }

    public function setTelenseignant($telenseignant): void {
        $this->telenseignant = $telenseignant;
    }

   

    static public function arrayToObjet($tableau) {
        $result = [];
        foreach ($tableau as $enseignant) {
            $E = new Enseignant($enseignant['NOM_ENSEIGNANT'], $enseignant['EMAIL_PROFESSIONNEL'], $enseignant['PRENOM_ENSEIGNANT'], $enseignant['TEL_ENSEIGNANT']);
            $E->idenseignant = $enseignant['ID_ENSEIGNANT'];
            array_push($result, $E);
        }

        return $result;
    }

}
