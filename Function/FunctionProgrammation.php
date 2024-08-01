<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once '../Database/Database1.php';
include_once '../Programmation/Programmation.php';

function getAllProgrammationJoin() {
    $db = new Database1();
    try {
// Préparez la requête SQL
        $sql = "
            SELECT *
            FROM programmer
            JOIN unite_ensignement ON programmer.ID_UE = unite_ensignement.ID_UE
            JOIN salle ON programmer.ID_SALLE = salle.ID_SALLE
            JOIN plage_horaire ON programmer.ID_HORAIRE = plage_horaire.ID_HORAIRE
            JOIN semaine ON programmer.ID_SEMAINE = semaine.ID_SEMAINE
            JOIN classe ON programmer.ID_CLASSE = classe.ID_CLASSE
            JOIN enseignant ON programmer.ID_ENSEIGNANT = enseignant.ID_ENSEIGNANT";

        $result = $db->executeQuery($sql);
        $result->execute();
//echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo 'erreuryo' . $exc->getMessage();
    }

// Récupérez tous les résultats

    $programmations = $result->fetchAll(PDO::FETCH_ASSOC);

    return $programmations;
}

$re = getProgrammation();
//var_dump($re);

function getProgrammation() {
    $db = new Database1();
    try {
// Préparez la requête SQL
        $sql = "SELECT * FROM programmer";
        $result = $db->executeQuery($sql);
        $result->execute();
//echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

// Récupérez tous les résultats

    $programmation = $result->fetchAll(PDO::FETCH_ASSOC);

    return $programmation;
}

function CreerTableauObjetprogrammer($prog) {
    $LesProgrammations = Programmation::arrayToObjet($prog);
    return $LesProgrammations;
}

function obtenirProgrammationParId($id, $Prog) {
    foreach ($Prog as $value) {
        if ($value['idprog'] == $id) {
            return $value;
        }
    }
    return null;
}

function UpdateProgrammation(Programmation $Prog) {

    $db = new Database1();
    $idclass = $Prog->getIdClasse();
    $idEnseig = $Prog->getIdEnseignant();
    $idhorraire = $Prog->getIdHoraire();
    $idsall = $Prog->getIdSalleP();
    $idsemaine = $Prog->getIdSemaine();
    $idue = $Prog->getIdUe();
    $id = $Prog->getIdprog();
    try {
        $sql = "UPDATE programmer "
                . "SET ID_UE ='$idue', "
                . "ID_SALLE ='$idsall', "
                . "ID_HORAIRE='$idhorraire', "
                . "ID_SEMAINE ='$idsemaine', "
                . "ID_CLASSE  = '$idclass', "
                . "ID_ENSEIGNANT   = '$idEnseig' "
                . "WHERE idprog = '$id'";
        $stmnt = $db->executeQuery($sql);
        $stmnt->execute();
        return 1;
    } catch (PDOException $ex) {
        echo 'Erreur de mise a jour: ' . $ex->getMessage();
    }
}

function SaveProgrammation(Programmation $Prog) {
    // Préparez la requête SQL
    $db = new Database1();
    $idclass = $Prog->getIdClasse();
    $idEnseig = $Prog->getIdEnseignant();
    $idhorraire = $Prog->getIdHoraire();
    $idsall = $Prog->getIdSalleP();
    $idsemaine = $Prog->getIdSemaine();
    $idue = $Prog->getIdUe();

    //Gestion des conflits de Programmation
    $conflitProgrammation = VerifierConflitProgramme($Prog);
    if ($conflitProgrammation) {
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Conflit de programme",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
        return;
    }
    //Gestion des conflits de salle
    $conflitSalle = VerifierConflitSalle($Prog);
    if ($conflitSalle) {
        include_once '../Programmation/Programmer.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Salle deja occupée",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
        return;
    }
    //Gestion des conflits d'etudiant
    $conflitEtudiant = VerifierConflitEtudiant($Prog);
    if ($conflitEtudiant) {
        include_once '../Programmation/Programmer.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Etudiant deja programmer",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
        return;
    }

    //Gestion conflit d'enseignant
    $conflitEnseignant = VerifierConflitEnseignant($Prog);
    if ($conflitEnseignant) {
        include_once '../Programmation/Programmer.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Enseignant deja programmer",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
        return;
    }


    try {
        $sql = 'INSERT INTO programmer(ID_UE, ID_SALLE, ID_HORAIRE, ID_SEMAINE, ID_CLASSE, ID_ENSEIGNANT) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idue, $idsall, $idhorraire, $idsemaine, $idclass, $idEnseig]);

        include_once '../Programmation/Programmer.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Programme valide",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
        return;
    } catch (PDOException $e) {

        echo "Erreur :" . $e->getMessage();
    }
}

//Gestion
function VerifierConflitSalle(Programmation $Prog) {
    $db = new Database1();
    $idhorraire = $Prog->getIdHoraire();
    $idsall = $Prog->getIdSalleP();
    $idsemaine = $Prog->getIdSemaine();

    try {
        $sql = "SELECT COUNT(*)
FROM programmer
WHERE ID_SALLE = ? AND ID_HORAIRE = ? AND ID_SEMAINE = ?";

        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idsall, $idhorraire, $idsemaine]);

        $conflitSalle = $stmt->fetchColumn() > 0;
        if ($conflitSalle) {
            return 'Cette salle est deja occuppée';
        }
        return null;
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
    }

    return $conflitSalle;
}

function VerifierConflitProgramme(Programmation $Prog) {
    $db = new Database1();
    $idclass = $Prog->getIdClasse();
    $idEnseig = $Prog->getIdEnseignant();
    $idhorraire = $Prog->getIdHoraire();
    $idsall = $Prog->getIdSalleP();
    $idsemaine = $Prog->getIdSemaine();
    $idue = $Prog->getIdUe();
    try {
        $sql = "SELECT COUNT(*) 
        FROM programmer 
        WHERE ID_UE = ? AND ID_CLASSE = ? AND ID_ENSEIGNANT  = ? AND ID_SALLE = ? AND ID_HORAIRE = ? AND ID_SEMAINE = ?";
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idue, $idclass, $idEnseig, $idsall, $idhorraire, $idsemaine]);
        $conflitProgrammation = $stmt->fetchColumn() > 0;
        if ($conflitProgrammation) {
            return 'Conflit de Programme detecter: Ce programme existe ';
        }
        return null;
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
    }
}

function VerifierConflitEtudiant(Programmation $Prog) {
    $db = new Database1();
    $idclass = $Prog->getIdClasse();
    $idhorraire = $Prog->getIdHoraire();
    $idsemaine = $Prog->getIdSemaine();

    try {
        $sql = "SELECT COUNT(*)
FROM programmer
WHERE ID_CLASSE = ? AND ID_HORAIRE = ? AND ID_SEMAINE = ?";
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idclass, $idhorraire, $idsemaine]);
        $conflitEtudiant = $stmt->fetchColumn() > 0;
        if ($conflitEtudiant) {
            return 'Les Etudiants de cette classe seront deja en cours';
        }
        return null;
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
    }
}

function VerifierConflitEnseignant(Programmation $Prog) {
    $db = new Database1();
    $idEnseignant = $Prog->getIdEnseignant();
    $idHoraire = $Prog->getIdHoraire();
    $idSemaine = $Prog->getIdSemaine();

    try {
        $sql = "SELECT COUNT(*) 
        FROM programmer 
        WHERE ID_ENSEIGNANT = ? AND ID_HORAIRE = ? AND ID_SEMAINE = ?";
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idEnseignant, $idHoraire, $idSemaine]);
        $conflitEnseignant = $stmt->fetchColumn() > 0;
        if ($conflitEnseignant) {
            return 'Cet enseignant a déjà un cours programmé à cette heure.';
        }
        return null;
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
    }
}

function VerifierConflitTroncCommun(Programmation $Prog) {
    $db = new Database1();
    $idclass = $Prog->getIdClasse();
    $idhorraire = $Prog->getIdHoraire();
    $idsemaine = $Prog->getIdSemaine();

    try {
        $sql = "SELECT COUNT(*)
                FROM programmer
                WHERE ID_CLASSE = ? AND ID_HORAIRE = ? AND ID_SEMAINE = ?";
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$idclass, $idhorraire, $idsemaine]);
        $conflitEtudiant = $stmt->fetchColumn() > 0;
        if ($conflitEtudiant) {
            return 'Les Etudiants de cette classe seront deja en cours';
        }
        return null;
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
    }
}
