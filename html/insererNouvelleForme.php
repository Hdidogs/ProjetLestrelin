<?php
include '../php/SQLConnexion.php';

if(isset($_POST['nouvelleForme'])) {
    $nouvelleForme = $_POST['nouvelleForme'];

    $conn = new SQLConnexion();
    $pdo = $conn->conbdd();

    $stmt = $pdo->prepare("INSERT INTO forme (libelle) VALUES (:nouvelleForme)");
    $stmt->bindParam(':nouvelleForme', $nouvelleForme);
    $stmt->execute();

    echo "Nouvelle forme ajoutée avec succès !";
} else {
    echo "Erreur : Aucune donnée reçue pour la nouvelle forme.";
}
?>
