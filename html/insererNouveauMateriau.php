<?php
include '../php/SQLConnexion.php';

if(isset($_POST['nouveauMateriau'])) {
    $nouveauMateriau = $_POST['nouveauMateriau'];

    $conn = new SQLConnexion();
    $pdo = $conn->conbdd();

    $stmt = $pdo->prepare("INSERT INTO materiau (libelle) VALUES (:nouveauMateriau)");
    $stmt->bindParam(':nouveauMateriau', $nouveauMateriau);
    $stmt->execute();

    echo "Nouveau matériau ajouté avec succès !";
} else {
    echo "Erreur : Aucune donnée reçue pour le nouveau matériau.";
}
?>
