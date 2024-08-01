<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Classe
 *
 * @author BenoitHarck
 */
class Classe {
    //put your code here
    private $IdClasse;
    private $IdDepartement;
    private $NomClasse;
    private $niveau;
    
    public function __construct($IdDepartement, $NomClasse, $niveau) {
        $this->IdDepartement = $IdDepartement;
        $this->NomClasse = $NomClasse;
        $this->niveau = $niveau;
    }

    public function getIdClasse() {
        return $this->IdClasse;
    }

    public function getIdDepartement() {
        return $this->IdDepartement;
    }

    public function getNomClasse() {
        return $this->NomClasse;
    }

    public function getNiveau() {
        return $this->niveau;
    }

    public function setIdDepartement($IdDepartement): void {
        $this->IdDepartement = $IdDepartement;
    }

    public function setNomClasse($NomClasse): void {
        $this->NomClasse = $NomClasse;
    }

    public function setNiveau($niveau): void {
        $this->niveau = $niveau;
    }

    static public function arrayToObjet($tableau) {
        $result=[];
        foreach ($tableau as $classe) {
            $C = new Classe($classe['ID_DEPARTEMENT'], $classe['NOM_CLASSE'], $classe['NIVEAU']);
            $C->IdClasse = $classe['ID_CLASSE'];
            array_push($result, $C);
        }
        
        return $result;
    }
}
