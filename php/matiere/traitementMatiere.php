<?php
include ";

if (array_key_exists("suppr", $_GET)) {
    $id = $_GET['id'];

    $matiere = new Matiere(['id'=>$id]);
    $matiere->supprimer();
}
?>
