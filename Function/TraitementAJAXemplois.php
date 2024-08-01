<?php

//trier le programme par classe
function filtrerProgrammesParClasse($TabProgrammation, $Classeselectionnee) {
    $programmesFiltres = array_filter($TabProgrammation, function ($progr) use ($Classeselectionnee) {
        return $progr['ID_CLASSE'] == $Classeselectionnee;
    });

    if (empty($programmesFiltres)) {
        echo '<h1>Programmation vide</h1>';
    }

    return $programmesFiltres;
}

//Trier les programmes par ordre des jours de la semaine
function trierProgrammesParJour($EmploiTemps, $ordreJours) {
    usort($EmploiTemps, function ($a, $b) use ($ordreJours) {
        return array_search($a['JOUR'], $ordreJours) - array_search($b['JOUR'], $ordreJours);
    });
    return $EmploiTemps;
}

//Groupons les programmes par semaine
function grouperProgrammesParSemaine($EmploiTemps) {
    $programmationsParSemaine = [];
    foreach ($EmploiTemps as $prog) {
        $programmationsParSemaine[$prog['NUMSEMAINE']][] = $prog;
    }
    return $programmationsParSemaine;
}

//Fabrication du tableau d'emploi de temps
function genererTableauHTML($programmationsParSemaine) {
    $jourActuel = null;
    $html = '';
    $html .= '<div id="impression">';
    foreach ($programmationsParSemaine as $numSemaine => $programmations) {

        foreach ($programmations as $prog) {

            $nomAcademie = "AGENLA ACADEMY";
            $anneeAcademique = "2023/2024";
            $semestre = "II";
            $filiere = "INGENIERIE INFORMATIQUE / COMPUTER ENGINEERING";
            $classe = "" . $prog['NOM_CLASSE'] . "" . $prog['NIVEAU'] . "";
            $html .= genererEnteteEmploiDuTemps($nomAcademie, $anneeAcademique, $semestre, $filiere, $classe);
            $html .= '<center><h2>Emploi du Temps</h2></center>';
            $html .= '<br>';
            $html .= "<h1>$numSemaine</h1>";
            $html .= '<table>';

            break;
        }
        // Ajouter les en-têtes de tableau
        $html .= '<tr>';
        $html .= '<th>Jour</th>';
        $html .= '<th>Plage</th>';
        $html .= '<th>Nom de l\'Enseignant</th>';
        $html .= '<th>Code du Cours</th>';
        $html .= '<th>Titre du Cours</th>';
        $html .= '<th>Numéro de la Salle</th>';
        $html .= '<th class="no-print">Editer</th>';
        $html .= '<th class="no-print">Supprimer</th>';
        $html .= '</tr>';

        // Construire les lignes du tableau pour chaque programme
        foreach ($programmations as $prog) {

            if ($prog['JOUR'] != $jourActuel) {

                // Nouveau jour, créer une nouvelle ligne de tableau pour le jour
                $html .= '<tr>';
                $html .= '<td rowspan="1" colspan="8">' . $prog['JOUR'] . '</td>';
                $html .= '</tr>';

                $jourActuel = $prog['JOUR'];
            }
            $html .= '<tr>'; // Pas besoin de colonne de jour pour les sous-lignes
            $html .= '<td>' . "  " . '</td>';

            $html .= '<td>' . $prog['PLAGE'] . '</td>';
            $html .= '<td>' . $prog['NOM_ENSEIGNANT'] . '</td>';
            $html .= '<td>' . $prog['CODE_UE'] . '</td>';
            $html .= '<td>' . $prog['LIBELLE_UE'] . '</td>';
            $html .= '<td>' . $prog['CODE_SALLE'] . '</td>';
            $html .= '<td class="no-print" onclick="window.location.href=\'../Programmation/EditProgrammation.php?id='
                . $prog['idprog'] . '\'"><button>Editer</button></td>';
            $html .= '<td class="no-print"><button>Supprimer</button></td>';
            $html .= '</tr>';
        }

        // Fermer le tableau HTML
        $html .= '</table>';
        $html .= genererFooter();
        $html .= '</div>';
        $html .= '<button onclick="imprimerEmploiDuTemps()">Imprimer l\'Emploi du Temps</button>';
        $html .= '<script>
                    function imprimerEmploiDuTemps() {
                        var contenuAImprimer = document.querySelector("#impression").innerHTML;
                        var fenetreImpression = window.open("", "_blank");
                        var styles = `<style>
                                        @media print {
                                            /* Vos styles d\'impression ici */
                                            table { width: 100%; height: 50%; border-collapse: collapse; }
                                            th, td { border: 1px solid black; padding: 5px; font-size: 22px; }
                                            .no-print { display: none; }
                                            /* Ajoutez d\'autres styles selon vos besoins */
                                        }
                                      </style>`;
                        fenetreImpression.document.write(styles + contenuAImprimer);
                        fenetreImpression.document.close();
                        fenetreImpression.focus();
                        fenetreImpression.print();
                        fenetreImpression.close();
                    }
                  </script>';
        $html .= '<br>'
                . '<br>'
                . '<br>'
                . '<br>';
    }
    // Retourner le tableau HTML
    return $html;
}

//Fonction entete emploi de temps
function genererEnteteEmploiDuTemps($nomAcademie, $anneeAcademique, $semestre, $filiere, $classe) {
    return <<<HTML
        <center>
            <div class="entete">

                    <div>
                        <img src="../image/logo.png" width="150px" alt="Logo" class="img"/>
                    </div>
                    <div class="fil0">
                        <label for="fil" class="fil">
                            <p> $nomAcademie / D- ESSI / CD- GI
                                ANNEE ACADEMIQUE/ ACADEMIC YEAR: $anneeAcademique<br>
                                EMPLOI DE TEMPS / TIME TABLE
                                SEMESTRE $semestre / SEMESTER $semestre<br><br>
                                Filière/ Field: $filiere</p>
                        </label>
                    </div>
                    <div class="fil1">
                        <label for="fil" class="fil"><h1>$classe</h1></label>
                    </div>

            </div>
        </center>    
HTML;
}

//Fonction footer emploi de temps
function genererFooter() {
    return <<<HTML
<footer>
    <div style="text-align: center;">
        <p>Le Chef de Département<br>
        The Head of Department</p>
        <br>
        <br>
        <br>
        <p>The Coordinator of Social, Business and Management programs

        Institut Universitaire Sous-Régional Bilingue des Mines, Sciences, Technologies, de Management et de Formations Professionnelles<br>
        Sub-Regional Bilingual University of Mines, Sciences, Technology, Management & Professional Training

        Autorisation / Authorization N°02/05599/N/MINESUP/DDES/ESUP/SAC/TNA/ebm du 26 Novembre 2012

        Situé à / Situated at NSA-ZOMO, entrée 10ème arrêt Nkoabang, Yaoundé - Cameroun

        N° Contribuable / Taxpayer’s N°: M111211716581W</p>
    </div>
</footer>
HTML;
}

// Generateur d'emploi de temps
function genererEmploiDuTemps($TabProgrammation, $Classeselectionnee) {
    $EmploiTemps = filtrerProgrammesParClasse($TabProgrammation, $Classeselectionnee);
    $ordreJours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $EmploiTempsTrie = trierProgrammesParJour($EmploiTemps, $ordreJours);
    $programmationsParSemaine = grouperProgrammesParSemaine($EmploiTempsTrie);
    return genererTableauHTML($programmationsParSemaine);
}



function obtenirEmploiDuTemps($TabProgrammation, $Classeselectionnee, $idSemaine) {
    // Filtrer les programmations pour la classe sélectionnée
    $programmesFiltres = array_filter($TabProgrammation, function ($progr) use ($Classeselectionnee) {
        return $progr['ID_CLASSE'] == $Classeselectionnee;
    });

    // Vérifier si des programmations ont été trouvées pour la classe sélectionnée
    if (empty($programmesFiltres)) {
        return '<h1>Programmation vide pour la classe sélectionnée</h1>';
    } else {
        // Initialiser un tableau pour stocker tous les programmes de la semaine spécifiée
        $programmesSemaine = [];

        // Rechercher tous les programmes pour la semaine spécifiée
        foreach ($programmesFiltres as $programmation) {
            if ($programmation['ID_SEMAINE'] == $idSemaine) {
                $programmesSemaine[] = $programmation;
            }
        }

        // Vérifier si des programmes ont été trouvés pour la semaine spécifiée
        if (!empty($programmesSemaine)) {
            return $programmesSemaine;
        } else {
            // Si aucun programme n'a été trouvé pour la semaine spécifiée
            return "Aucun emploi du temps trouvé pour la semaine $idSemaine.";
        }
    }
}
