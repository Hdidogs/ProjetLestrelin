<?php
include "../../model/Entreprise.php";

if (array_key_exists("add", $_GET)) {
    $id = $_GET['id'];

    $entreprise = new Entreprise(['nom'=>$_GET['nom'], 'mail'=>$_GET['mail'], 'tel'=>$_GET['tel']]);
    $entreprise->ajouter();
}
?>
