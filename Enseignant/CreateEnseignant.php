<?php
session_start();
//importation des fichiers
include_once '../Function/FunctionEnseignant.php';
include_once '../Function/TransformationBD.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gestionnaire d'enseignant</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/AA.ico" type="image/x-icon">
        <link rel="stylesheet" href="../Style/Form.css">
        <link rel="stylesheet" href="../Style/Body.css">
        <link rel="stylesheet" href="../Style/Tableau.css">
        <link rel="stylesheet" href="../Style/Home-css/header.css"/>
        <script src="../jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../package/dist/sweetalert2.min.css">
        <script src="../package/dist/sweetalert2.min.js"></script>
    </head>

    <body>
        <div class="container">
            <header class="eltmntHead">
                <div class="LogoTitre">
                    <img src="../image/logo.png" width="100px" height="" alt="alt" class="img1"/>
                    <span class="sp">Gest-Emploi de temps</span>
                </div>
                <div class="profil">
                    <a href="../Departement/DepartementIGL.php">EMPLOI DE TEMPS</a>
                    <a href="#">PROFIL</a>
                </div>
            </header>
            <br>
            <br>
            <div class="formulaire">
                <div class="TitreImg">
                    <h2 class="titreform">GESTIONNAIRE D'ENSEIGNANT</h2>
                    <img src="../image/logo.png" width="150px" height="" alt="alt" class="img1"/>
                </div>
                <div class="formtab">
                    <form method="POST" action="Post_enseignant.php" class="f">
                        <p>Informations Personnels</p>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required="required">

                        <label for="prenom">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" required="required">
                        <br>
                        <br>
                        <br>
                        <label for="telephone">Telephone :</label>
                        <input type="tel" id="telephone" name="telephone" required="required">

                        <label for="email">Email Professionnel :</label>
                        <input type="email" id="email" name="email" required="required">
                        <br>
                        <br>
                        <br>
                        <input type="submit" value="Enregistrer" class="sub">
                    </form>
                    <br>
                    <br>
                    <?php
                    echo afficherTabEnseignants($Tabenseignants);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>


