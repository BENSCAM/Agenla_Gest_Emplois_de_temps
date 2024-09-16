<?php

include_once '../Function/FunctionProgrammation.php';

$valeursemaine = $_POST['semaine'];
$valeurperiode = $_POST['periode'];

$salles= getAvailableSalles($valeursemaine,$valeurperiode);

// Générer le HTML pour les salles
$html = '<option value="" disabled hidden>Choisissez une salle</option>';

foreach ($salles as $salle) {
    $isOccupied = $salle['Occupation'] > 0; // Vérifie si la salle est programmée

    $html .= '<option value="' . $salle['ID_SALLE'] . '"';
    if ($isOccupied) {
        $html .= ' disabled style="color: grey;"'; // Griser les salles occupées
    }
    $html .= '>' . $salle['CODE_SALLE'] . ' (' . $salle['Capacite'] . ' places)</option>';
}

echo $html;