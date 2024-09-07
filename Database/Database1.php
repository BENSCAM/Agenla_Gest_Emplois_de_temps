<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Database1
 *
 * @author BenoitHarck
 */
class Database1 {

     private $host = 'localhost'; // Adresse du serveur MySQL
     private $dbname = 'gest_edt'; // Nom de la base de données
     private $username = 'BenoitHarck'; // Nom d'utilisateur MySQL
     private $password = 'Benoit1212!@'; // Mot de passe MySQL
     private $connection; // Objet de connexion à la base de données
    


    public function __construct() {
        try {
            // Crée une instance de connexion PDO
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Configure les options de connexion (par exemple, gestion des erreurs)
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'connexion reussie';
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

// Méthode pour exécuter une requête SQL
    public function executeQuery($sql) {
        try {
            $stmt = $this->connection->prepare($sql);
//            var_dump($stmt);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Erreur d'exécution de la requête : " . $e->getMessage());
        }
    }

}
