<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Semaine
 *
 * @author BenoitHarck
 */
class Semaine {
    //put your code here
    private $idsemaine;
    private $numsemaine;
    
    public function __construct($numsemaine) {
        $this->numsemaine = $numsemaine;
    }

    
    public function getIdsemaine() {
        return $this->idsemaine;
    }

    public function getNumsemaine() {
        return $this->numsemaine;
    }

    public function setNumsemaine($numsemaine): void {
        $this->numsemaine = $numsemaine;
    }

    static public function arrayToObjet($tableau) {
        $result=[];
        foreach ($tableau as $Semaine) {
            $S = new Semaine($Semaine['NUMSEMAINE']);
            $S->idsemaine = $Semaine['ID_SEMAINE'];
            array_push($result, $S);
        }
        
        return $result;
    }

}
