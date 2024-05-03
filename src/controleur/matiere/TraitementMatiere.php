<?php

use matiere\Matiere;

include "../../model/matiere/Matiere.php";
include "../../model/bdd/SQLConnexion.php";
if (array_key_exists("suppr", $_GET)) {
    $id = $_GET['id'];

    $matiere = new Matiere(['id' => $id]);
    $matiere->supprimer();
} else if (array_key_exists("debit", $_GET)) {
    $matiere = new Matiere([
        'date' => $_GET['date'],
        'quantite' => $_GET['quantite'],
        'piece' => $_GET['piece'],
        'user' => $_GET['user'],
        'matiere' => $_GET['matiere'],
        'classe' => $_GET['classe']
    ]);
    $matiere->debit();
} else if (array_key_exists("commande", $_GET)) {
    $conn = new SQLConnexion();

    $matiere = new Matiere([
        'date' => $_GET['date'],
        'quantite' => $_GET['quantite'],
        'etat' => $_GET['etat'],
        'num' => $_GET['num'],
        'user' => $_GET['user'],
        'fournisseur' => $_GET['fournisseur'],
        'matiere' => $_GET['matiere'],
        'classe' => $_GET['classe']
    ]);

    $matiere->commande();

} else if (array_key_exists("ajout", $_GET)) {
    $matiere = new Matiere([
        'nom' => $_GET['nom'],
        'unite' => $_GET['unite'],
        'stock' => $_GET['stock'],
        'seuil' => $_GET['seuil'],
        'classe' => $_GET['classe']
    ]);
    $matiere->ajouter();
} else if (array_key_exists("modif", $_GET)) {
    $matiere = new Matiere([
        'id' => $_GET['id'],
        'nom' => $_GET['nom'],
        'unite' => $_GET['unite'],
        'stock' => $_GET['stock'],
        'seuil' => $_GET['seuil'],
        'classe' => $_GET['classe']
    ]);
    $matiere->modifier();
} else if (array_key_exists("addForme", $_GET)) {
    $matiere = new Matiere([
        'id' => $_GET['id'],
        'forme' => $_GET['forme'],
        'largeur' => $_GET['largeur'],
        'hauteur' => $_GET['hauteur'],
        'longueur' => $_GET['longueur'],
        'epaisseur' => $_GET['epaisseur'],
        'diametre' => $_GET['diametre']
    ]);
}

if (isset($_POST['addnewMatiere'])) {
    // récupération des données du formulaire
    $materiau = $_POST['materiau'];
    $forme = $_POST['forme'];
    $longueur = $_POST['longueur'];
    $largeur = $_POST['largeur'];
    $epaisseur = $_POST['epaisseur'];
    $diametre = $_POST['diametre'];
    $hauteur = $_POST['hauteur'];

    // vérification si toutes les données sont présentes
    if (!empty($materiau) && !empty($forme)) {
        //Requête SQL
        $sql = "INSERT INTO matiere (id_materiau, id_forme, longueur, largeur, epaisseur, diametre, hauteur) 
        VALUES (:materiau, :forme, :longueur, :largeur, :epaisseur, :diametre, :hauteur)";
        //Exécution de la requête
        if ($conn->query($sql) === TRUE) {
            // Redirection vers la page principale
            header('Location: ../../../vue/gestionMatiere.php');
        } else {
            echo "Une erreur s'est produite: ";
        }
    } else {
        echo "Tous les champs sont obligatoires";
    }
}


header('Location: ../../../vue/main/index.php');