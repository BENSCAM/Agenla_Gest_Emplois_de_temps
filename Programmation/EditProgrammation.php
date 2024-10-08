
<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
include_once '../Function/FunctionClasse.php';
include_once '../Function/FunctionSalle.php';
include_once '../Function/FunctionHoraire.php';
include_once '../Function/FunctionUe.php';
include_once '../Function/FunctionProgrammation.php';
include_once '../Function/TransformationBD.php';


$TabProgram= getAllProgrammationJoin();
$lesProgs = obtenirProgrammationParId($_GET['id'], $TabProgram);

?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Gest-programmation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Style/Form.css">
        <link rel="stylesheet" href="../Style/Body.css">
        <link rel="stylesheet" href="../Style/Home-css/Header.css"/>
        <!--        <link rel="stylesheet" href="../Style/Tableau.css">
                <link rel="stylesheet" href="../Style/Home-css/Header.css"/>-->
        <script src="../jquery/dist/jquery.min.js"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

    </head>
    <!--    /* 
        * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
        * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
        */-->
    <script >
        $(document).ready(function () {
            $('#IdclassSelect').change(function () {
                var valeurSelectionnee = $(this).val();
                console.log(valeurSelectionnee);
                $.ajax({
                    url: '../Function/TraitementAJAX.php', // Remplacez par le chemin de votre fichier PHP
                    method: 'POST',
                    data: {
                        valeur: valeurSelectionnee
                    },
                    success: function (html) {
                        //console.log(html);
                        $('#IdueSelect').html(html);

                    }
                });
            });
        });


    </script>

    <script >
        $(document).ready(function () {
            $('#IdueSelect').change(function () {
                var valeurSelectionnee = $(this).val();
                console.log(valeurSelectionnee);
                $.ajax({
                    url: '../Function/TraitementAJAXue.php', // Remplacez par le chemin de votre fichier PHP
                    method: 'POST',
                    data: {
                        valeur: valeurSelectionnee
                    },
                    success: function (TabEnseig) {
                        //console.log(html);
                        $('#IdEnseignantSelect').html(TabEnseig);

                    }
                });
            });
        });


    </script>


    <body>
        <div class="container">
            <header class="eltmntHead">
                <div class="LogoTitre">
                    <img src="../image/logo.png" width="100px" height="" alt="alt" class="img1"/>
                    <span class="sp">Gest-Emploi de temps</span>
                </div>
                <div class="profil">
                    <a href="../Departement/DepartementIGL.php">EMPLOI DE TEMPS</a>
                    <a href="../home.php">ACCEUIL</a>
                </div>
            </header>
            <br>
            <br>
            <br>
            <div class="formulaire">
                <div class="TitreImg">
                    <h2 class="titreform">Programmation des cours</h2>
                    <img src="../image/logo.png" width="150px" height="" alt="alt" class="img1"/>
                </div>
                <div class="formtab">
                    <form method="POST" action="Update.php" class="f">
                        <br>
                        <br>
                        <label for="Unite">Semaine :</label>
                         <input type="hidden" id="id" name="id" value="<?php echo($_GET['id']); ?>">
                        <select name="semaineSelect" class="combobox" id="IdsemaineSelect">
                            <option value="" selected disabled hidden class="Selsalle"><?php echo $lesProgs['NUMSEMAINE']?></option>
                            <?php
                            echo afficherSemaine($Tabsemaines);
                            ?>

                            <label for="Horaire">Horaire :</label>
                            <select name="horaireSelect" class="combobox" id="IdhoraireSelect">
                                <option value="" selected disabled hidden><?php echo $lesProgs['PLAGE'].'~~'.$lesProgs['JOUR']?></option>
                                <?php
                                echo afficherHoraire($TabHoraires);
                                ?>
                            </select>
                            <br>
                            <br>
                            <label for="Classe">Classe :</label>
                            <select name="classSelect" id="IdclassSelect" class="combobox">
                                <option value="" selected disabled hidden><?php echo $lesProgs['NOM_CLASSE'].''.$lesProgs['NIVEAU']?></option>
                                <?php
                                echo afficherClasses($Tabclasses);
                                ?>
                            </select>

                            <label for="Unite">Unite d'enseignement :</label>
                            <select name="ueSelect" class="combobox" id="IdueSelect">
                                <option value="" selected disabled hidden><?php echo $lesProgs['LIBELLE_UE']?></option>
                                <?php
                                echo afficherUe($TabUes);
                                ?>
                            </select>    
                            <br>
                            <br>
                            <br>
                            <label for="Salle">Salle :</label>
                            <select name="salleSelect" class="combobox" id="IdsalleSelect">
                                <option value="" selected disabled hidden class="Selsalle"><?php echo $lesProgs['CODE_SALLE']?></option>
                                <?php
                                echo afficherSalle($Tabsalles);
                                ?>
                            </select>
                            <label for="Enseignant">Enseignant :</label>
                            <select name="enseigSelect" class="combobox" id="IdEnseignantSelect">

                                <option value="" selected disabled hidden class="Selsalle"><?php echo $lesProgs['NOM_ENSEIGNANT'].' '.$lesProgs['PRENOM_ENSEIGNANT']?></option>
                                <?php
                                echo afficherEnseignants($Tabenseignants);
                                ?>
                            </select>
                            <br>
                            <br>
                            <br>
                            <input type="submit" value="Mettre a jour" class="sub">
                            </form>
                            <br>
                            <br>
                            </div>
                            </div>
                            </div>

                            </body>
                            </html>

