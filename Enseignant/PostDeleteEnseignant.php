<?php 

    //importation des fichiers

    include_once '../Function/FunctionEnseignant.php';
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo 'Il faut un identifiant de l\'enseignant pour le modifier.';
//    return;
}

$id=intval($_GET['id']);
if(Delete($id)==1){
    
    include_once '../Enseignant/CreateEnseignant.php';
        echo '<script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Enseignant supprimé",
                showConfirmButton: false,
                timer: 2500
            });
        </script>';
}
//try{
//    Delete($id);
//    echo 'Enseignant Supprimer avec succes';
//} catch (Exception $e){
//    
//}
//echo '<a href="CreateEnseignant.php">Retourner </a>';



