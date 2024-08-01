<?php
include_once '../Function/FunctionProgrammation.php';
include_once '../Function/TraitementAJAXemplois.php';
include_once '../Function/TransformationBD.php';
?>
<html>
    <head>
        <link rel="shortcut icon" href="../image/AA.ico" type="image/x-icon">
        <title>Departement-Gest Agenla</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Style/Home-css/header.css"/>
        <link rel="stylesheet" href="../Style/Departements/Element.css"/><!--
        <link rel="stylesheet" href="../Style/Departements/verticalbar.css"/>-->
        <link rel="stylesheet" href="../Style/ElmntAcc/EL.css"/>
        <script src="../jquery/dist/jquery.min.js"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
        <!-- Toggle Menu CSS -->
        <link rel="stylesheet" href="../Style/Departements/css/style.css">
        <!--Only for demo purpose - no need to add.-->
        <link rel="stylesheet" href="../Style/Departements/css/demo.css" />

    </head>

<!--    <script>
        var element = document.querySelector('a'); // Sélectionnez l'élément
        var valeur = element.dataset.valeur; // Accédez à la valeur
        console.log(valeur);
    </script>-->

    <body>
        <div class="container-page">
            <header class="eltmntHead">
                <div class="LogoTitre">
                    <img src="../image/logo.png" width="100px" height="" alt="alt" class="img1"/>
                    <span class="sp">Gest-Emploi de temps</span>
                </div>
                <div class="profil">
                    <a href="../Programmation/Programmer.php">PROGRAMMER</a>
                    <a href="../home.php">ACCEUIL</a>
                </div>
            </header>

            <div class="Contnav_link">
                <div class="navbar">

                    <section>
                        <div class="rt-container">
                            <div class="col-rt-12">
                                <div class="Scriptcontent">

                                    <!-- Start Menu HTML -->
                                    <div class="header"></div>
                                    <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">

                                    <label for="openSidebarMenu" class="sidebarIconToggle">
                                        <div class="spinner diagonal part-1"></div>
                                        <div class="spinner horizontal"></div>
                                        <div class="spinner diagonal part-2"></div>
                                    </label>

                                    <div id="sidebarMenu">
                                        <ul class="sidebarMenuInner">
                                            <?php
                                            echo AfficherListeClasse($Tabclasses);
                                            ?>
                                        </ul>
                                    </div>
<!--                                    <div class="dropdown">
                                        <button class="dropbtn">Semaines</button>
                                        <div class="dropdown-content">
                                            <?php
                                            // PHP pour récupérer les semaines de la base de données
                                            //echo AfficherListeSemaine($Tabsemaines);
                                            ?>
                                        </div>
                                    </div>-->
                                    <!-- End Menu HTML -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
            <br>
            <br>
            <br>
            <br>

            <div class="links">

                <div id="EploisTmps">
                    <center>
                        <?php
                        if (!isset($_GET['id'])) {
                            echo '<h1>Selectionner une classe en deroulant le menu avec les trois traits</h1>';
                        } else {
                            $TabProgrammation = getAllProgrammationJoin();
                            // Désactive l'affichage des erreurs
                            error_reporting(0);
                            ini_set('display_errors', 0);

                            $id = $_GET['id'];
                            $idsemaine = $_GET['idsemaine'];
                            //var_dump($idsemaine);
                            // Réactive l'affichage des erreurs
                            error_reporting(E_ALL);
                            ini_set('display_errors', 1);

                            if (isset($idsemaine)) {
                                // Affiche l'emploi du temps pour la semaine spécifiée
                                echo genererEmploiDuTemps(obtenirEmploiDuTemps($TabProgrammation, $id, $idsemaine), $id);
                            } else {
                                // Affiche tous les emplois du temps pour la classe sélectionnée
                                echo genererEmploiDuTemps($TabProgrammation, $id);
                            }
                        }
                        ?>

                    </center>

                </div>

            </div>
        </div>
    </body>


</html>