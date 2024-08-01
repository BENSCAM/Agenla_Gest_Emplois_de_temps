<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Programmation
 *
 * @author BenoitHarck
 */
class Programmation {

    //Propriete declaree privee
    private $IdEnseignant;
    private $IdUe;
    private $IdSalle;
    private $IdHoraire;
    private $IdSemaine;
    private $IdClasse;
    private $idprog;

    public function __construct($IdEnseignant=null, $IdUe=null, $IdSalle=null, $IdHoraire=null, $IdSemaine=null, $IdClasse=null) {
        $this->IdUe = $IdUe;
        $this->IdSalle = $IdSalle;
        $this->IdHoraire = $IdHoraire;
        $this->IdSemaine = $IdSemaine;
        $this->IdClasse = $IdClasse;
        $this->IdEnseignant = $IdEnseignant;
    }
    
    public function MemoryUpdateE($id,$IdEnseignant, $IdUe, $IdSalle, $IdHoraire, $IdSemaine, $IdClasse) {
       $this->IdUe = $IdUe;
        $this->IdSalle = $IdSalle;
        $this->IdHoraire = $IdHoraire;
        $this->IdSemaine = $IdSemaine;
        $this->IdClasse = $IdClasse;
        $this->IdEnseignant = $IdEnseignant;
        $this->idprog=$id;
    }

    public function getIdEnseignant() {
        return $this->IdEnseignant;
    }

    public function setIdEnseignant($IdEnseignant): void {
        $this->IdEnseignant = $IdEnseignant;
    }

    public function getIdUe() {
        return $this->IdUe;
    }

    public function getIdSalleP() {
        return $this->IdSalle;
    }

    public function getIdHoraire() {
        return $this->IdHoraire;
    }

    public function getIdprog() {
        return $this->idprog;
    }   

    public function getIdSemaine() {
        return $this->IdSemaine;
    }

    public function getIdClasse() {
        return $this->IdClasse;
    }

    public function setIdUe($IdUe): void {
        $this->IdUe = $IdUe;
    }

    public function setIdSalle($IdSalle): void {
        $this->IdSalle = $IdSalle;
    }

    public function setIdHoraire($IdHoraire): void {
        $this->IdHoraire = $IdHoraire;
    }

    public function setIdSemaine($IdSemaine): void {
        $this->IdSemaine = $IdSemaine;
    }

    public function setIdClasse($IdClasse): void {
        $this->IdClasse = $IdClasse;
    }

    static public function arrayToObjet($tableau) {
        $result = [];
        foreach ($tableau as $prog) {
            $p = new Programmation($prog['ID_ENSEIGNANT'], $prog['ID_UE'], $prog['ID_SALLE'], $prog['ID_HORAIRE'], $prog['ID_SEMAINE'], $prog['ID_CLASSE']);
            $p->idprog=$prog['idprog'];
            array_push($result, $p);
        }

        return $result;
    }

}
