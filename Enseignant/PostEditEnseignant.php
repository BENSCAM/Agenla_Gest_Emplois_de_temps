<?php

include_once '../Function/FunctionEnseignant.php';
include_once '../Function/TransformationBD.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Il faut un identifiant de l\'enseignant pour le modifier.';
    return;
}

$EnseigId=obtenirEnseignantParId($_GET['id'], $Tabenseignants );
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <link rel="shortcut icon" href="../image/AA.ico" type="image/x-icon">
        <title>Gestionnaire d'enseignant</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Style/Form.css">
        <link rel="stylesheet" href="../Style/body.css">
        <link rel="stylesheet" href="../Style/Tableau.css">
    </head>
    <body>
        <div class="container">
            <div class="formulaire">
                <div class="TitreImg">
                    <h2 class="titreform">METTRE A JOUR LES DONNEES DE M./Mme <?php echo $EnseigId->getNomenseignant() ?></h2>
                    <img src="../image/logo.png" width="150px" height="" alt="alt" class="img1"/>
                </div>
                <div class="formtab">
                    <form method="POST" action="Update.php" class="f">
                        <p>Informations Personnels</p>
                        <label for="nom">Nom :</label>
                        <input type="hidden" id="id" name="id" value="<?php echo($_GET['id']); ?>">
                        <input type="text" id="nom" name="nom" required="required" value="<?php echo $EnseigId->getNomenseignant() ?>">

                        <label for="prenom">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" required="required"value="<?php echo $EnseigId->getPrenomenseignant() ?>">
                        <br>
                        <br>
                        <br>
                        <label for="telephone">Telephone :</label>
                        <input type="tel" id="telephone" name="telephone" required="required" value="<?php echo $EnseigId->getTelenseignant()?>">

                        <label for="email">Email Professionnel :</label>
                        <input type="email" id="email" name="email" required="required" value="<?php echo $EnseigId->getEmailenseignant() ?>">
                        <br>
                        <br>
                        <br>
                        <input type="submit" value="Mettre à jour" class="sub">
                    </form>
                    <br>
                    <br>
                    <?php
                        //importation des fichiers
                        include_once '../Function/FunctionEnseignant.php';
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>