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
} else if (array_key_exists("commande", $_GET)) {
    $matiere = new Matiere(['date'=>$_GET['date'],
        'quantite'=>$_GET['quantite'],
        'etat'=>$_GET['etat'],
        'num'=>$_GET['num'],
        'user'=>$_GET['user'],
        'fournisseur'=>$_GET['fournisseur'],
        'matiere'=>$_GET['matiere'],
        'classe'=>$_GET['classe']]);
    $matiere->commande();
}
?>
