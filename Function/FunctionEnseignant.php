<?php

//inclusion des fichiers
include_once '../Database/Database1.php';
include_once '../Enseignant/Enseignant.php';

function getEnseignants() {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT * FROM enseignant";
        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $enseignants = $result->fetchAll(PDO::FETCH_ASSOC);

    return $enseignants;
}

//conversion des objets de la base de donnee en Enseignant
function CreerTableauObjetenseignant($enseignants) {
    $LesEnseignants = Enseignant::arrayToObjet($enseignants);
    return $LesEnseignants;
}

function obtenirEnseignantParId($id, $enseignants) {
    foreach ($enseignants as $value) {
        if ($value->getIdenseignant() == $id) {
            return $value;
        }
    }
    return null;
}

function Delete($id) {
    $db = new Database1();

    $sql = 'DELETE FROM enseignant WHERE ID_ENSEIGNANT=' . $id;

    try {
        $result = $db->executeQuery($sql);
        $result->execute();
        return 1;
    } catch (PDOException $e) {
        $error = "Une erreur s\'est produite";
        echo '<script type="text/javascript">alert("' . $error . '");</script>';
    }
}

function SaveEnseignant(Enseignant $enseignant) {


    // Préparez la requête SQL
    $db = new Database1();
    $nom = $enseignant->getNomenseignant();
    $prenom = $enseignant->getPrenomenseignant();
    $email = $enseignant->getEmailenseignant();
    $tel = $enseignant->getTelenseignant();

    try {
        $sql = 'INSERT INTO enseignant(NOM_ENSEIGNANT, EMAIL_PROFESSIONNEL, PRENOM_ENSEIGNANT, TEL_ENSEIGNANT) VALUES (?, ?, ?, ?)';
        $stmt = $db->executeQuery($sql);
        $stmt->execute([$nom, $email, $prenom, $tel]);
        
        return 1;
    } catch (PDOException) {

      return 0;
    }
}

function UpdateEnseignant(Enseignant $enseignant) {

    $db = new Database1();
    $nom = $enseignant->getNomenseignant();
    $prenom = $enseignant->getPrenomenseignant();
    $email = $enseignant->getEmailenseignant();
    $tel = $enseignant->getTelenseignant();
    $id = $enseignant->getIdenseignant();
    try {
        $sql = "UPDATE enseignant "
                . "SET NOM_ENSEIGNANT='$nom', "
                . "EMAIL_PROFESSIONNEL='$email', "
                . "PRENOM_ENSEIGNANT='$prenom', "
                . "TEL_ENSEIGNANT='$tel' "
                . "WHERE ID_ENSEIGNANT='$id'";
        $stmnt = $db->executeQuery($sql);
        $stmnt->execute();
        return 1;
    } catch (PDOException $ex) {
        echo 'Erreur de mise a jour: ' . $ex->getMessage();
    }
}

function afficherTabEnseignants($enseignants) {

    if ($enseignants == null) {
        echo'<h1 class="notfound">Base de donnée vide!!!</h1>';
        return;
    }
    // Début du tableau
    $html = '<table class="tab">';
    $html .= '<tr class="tabhead"><th>ID</th><th>Nom</th><th>Email</th><th>Prenom</th><th>Telephone</th><th>Editer</th></tr>'; // En-têtes du tableau
    // Parcourir chaque enseignant
    foreach ($enseignants as $enseignant) {
        $html .= '<tr class="white-text">';
        $html .= '<td>' . $enseignant->getIdenseignant() . '</td>';
        $html .= '<td>' . $enseignant->getNomenseignant() . '</td>';
        $html .= '<td>' . $enseignant->getEmailenseignant() . '</td>';
        $html .= '<td>' . $enseignant->getPrenomenseignant() . '</td>';
        $html .= '<td>' . $enseignant->getTelenseignant() . '</td>';
        $html .= '<td>' . '<Button class="E" onclick="window.location.href=\'../Enseignant/PostEditEnseignant.php?id='
                . $enseignant->getIdenseignant() . '\'">Editer</button>' .
                '<br>' .
                '<button class="S" onclick="if(confirm(\'Êtes-vous sûr de vouloir supprimer cet article ?\'))'
                . ' { window.location.href=\'../Enseignant/PostDeleteEnseignant.php?id=' . $enseignant->getIdenseignant() . '\' }">Supp</button>' .
                '</td>';

        $html .= '</tr>';
    }
    $html .= '</table>'; // Fin du tableau
    return $html;
}

function afficherEnseignants($enseignants) {

    // Parcourir chaque classe
    foreach ($enseignants as $enseig) {
        $html .= '<option value="' . $enseig->getIdenseignant() . '">';
        $html .= $enseig->getNomenseignant() . " " . $enseig->getPrenomenseignant();
        $html .= '</option>';
    }
    return $html;
}

function getEnseigByUe($id) {
    $db = new Database1();
    try {
        // Préparez la requête SQL
        $sql = "SELECT enseignant.NOM_ENSEIGNANT,enseignant.PRENOM_ENSEIGNANT,enseignant.ID_ENSEIGNANT  "
                . "FROM enseignant,dispenser "
                . "WHERE enseignant.ID_ENSEIGNANT = dispenser.ID_ENSEIGNANT"
                . " AND ID_UE=" . $id;

        $result = $db->executeQuery($sql);
        $result->execute();
        //echo 'Lecture reussie';
    } catch (Exception $exc) {
        echo 'Erreur :' . $exc->getTraceAsString();
    }

    // Récupérez tous les résultats

    $EnseigByUe = $result->fetchAll(PDO::FETCH_ASSOC);

    return $EnseigByUe;
}
