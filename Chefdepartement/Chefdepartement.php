<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Chefdepartement
 *
 * @author BenoitHarck
 */
class Chefdepartement extends Enseignant{
    private $idchefdepartement;
    private $nomdepartement;
    
   public function __construct($nomdepartement = null, $nomenseignant = null, $emailenseignant = null, $prenomenseignant = null, $telenseignant = null) {
        parent::__construct($nomenseignant, $emailenseignant, $prenomenseignant, $telenseignant);
        $this->idchefdepartement = 0;
        $this->nomdepartement = $nomdepartement;
    }
    
    public function MemoryUpdate($nomdepartement,$nomenseignant, $emailenseignant, $prenomenseignant, $telenseignant) {
        parent::MemoryUpdate($nomenseignant, $emailenseignant, $prenomenseignant, $telenseignant);
        $this->nomdepartement=$nomdepartement;
    }

    public function getIdchefdepartement() {
        return $this->idchefdepartement;
    }

    public function getNomdepartement() {
        return $this->nomdepartement;
    }

    public function setNomdepartement($nomdepartement): void {
        $this->nomdepartement = $nomdepartement;
    }


}
