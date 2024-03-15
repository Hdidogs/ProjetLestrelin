<?php
include "Matiere.php";

if (array_key_exists("suppr", $_GET)) {
    $id = $_GET['id'];

    $matiere = new Matiere(['id'=>$id]);
    $matiere->supprimer();
} else if (array_key_exists("debit", $_GET)) {
    $matiere = new Matiere(['date'=>$_GET['date'],
        'quantite'=>$_GET['quantite'],
        'piece'=>$_GET['piece'],
        'user'=>$_GET['user'],
        'matiere'=>$_GET['matiere'],
        'classe'=>$_GET['classe']]);
    $matiere->debit();
}
?>
