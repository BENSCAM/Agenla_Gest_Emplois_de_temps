<?php

//inclusion des fichiers
include_once 'Enseignant.php';
include_once '../Function/FunctionEnseignant.php';

//Verification des donnee du forumulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (!isset($nom) || !isset($prenom) || !isset($telephone) || !isset($email)) {
    echo 'Il faut bien renseigner le formulaire pour enregistrer la requete';
    return;
} else {

    //Creation d'un objet(Enseignant) avec les elements venant du formulaire
    $Enseig = new Enseignant($nom, $email, $prenom, $telephone);

    if (SaveEnseignant($Enseig) == 1) {
        include_once '../Enseignant/CreateEnseignant.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Enseignant enregistré",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
    } else {
        include_once '../Enseignant/CreateEnseignant.php';
        echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Email existe déjà",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>';
    }
}







