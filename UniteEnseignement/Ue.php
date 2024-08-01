<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Ue
 *
 * @author BenoitHarck
 */
class Ue {

    //put your code here
    private $IdUe;
    private $IdClasse;
    private $CodeUe;
    private $libelleUe;
    private $iddepartement;
    private $controleTC;

    public function __construct($IdClasse, $CodeUe, $libelleUe,$iddepartement,$CTC) {
        $this->IdClasse = $IdClasse;
        $this->CodeUe = $CodeUe;
        $this->libelleUe = $libelleUe;
        $this->iddepartement=$iddepartement;
        $this->controleTC=$CTC;
    }

    public function getControleTC() {
        return $this->controleTC;
    }

    public function setControleTC($controleTC): void {
        $this->controleTC = $controleTC;
    }

        public function getIdUe() {
        return $this->IdUe;
    }

    public function getIdClasse() {
        return $this->IdClasse;
    }

    public function getCodeUe() {
        return $this->CodeUe;
    }

    public function getLibelleUe() {
        return $this->libelleUe;
    }
    public function getIddepartement() {
        return $this->iddepartement;
    }

    public function setIdClasse($IdClasse): void {
        $this->IdClasse = $IdClasse;
    }

    public function setCodeUe($CodeUe): void {
        $this->CodeUe = $CodeUe;
    }

    public function setIddepartement($iddepartement): void {
        $this->iddepartement = $iddepartement;
    }

        public function setLibelleUe($libelleUe): void {
        $this->libelleUe = $libelleUe;
    }

    static public function arrayToObjet($tableau) {
        $result=[];
        foreach ($tableau as $ue) {
            $u = new Ue($ue['ID_CLASSE'], $ue['CODE_UE'], $ue['LIBELLE_UE'],$ue['ID_DEPARTEMENT'],$ue['CONTROLETC']);
            $u->IdUe=$ue['ID_UE'];
            array_push($result, $u);
        }
        
        return $result;
    }
}
