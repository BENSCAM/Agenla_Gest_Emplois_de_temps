<?php

include_once 'Enseignant.php';
include_once '../Function/FunctionEnseignant.php';

//Verification des donnee du forumulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!isset($nom) || !isset($prenom) || !isset($telephone) || !isset($email) || !isset($id)) {
    echo 'Il faut bien renseigner le formulaire pour enregistrer la requete';
    return;
} else {

    //Creation d'un objet(Enseignant) avec les elements venant du formulaire
    $Enseig = new Enseignant();
    $Enseig->MemoryUpdate($id, $nom, $email, $prenom, $telephone);
    UpdateEnseignant($Enseig);
    if (UpdateEnseignant($Enseig)) {

        include_once '../Enseignant/CreateEnseignant.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Enseignant modifier",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
    }
    
       include_once '../Enseignant/CreateEnseignant.php';
}