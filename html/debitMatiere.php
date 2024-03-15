<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Panel de Gestion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <link rel="stylesheet" href="../css/styles.css"/>

    <!-- JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>
<body>
<?php

include '../php/SQLConnexion.php';

session_start();
$conn = new SQLConnexion();

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: ../html/connexion.html");
}
?>
<div class="side-bar-big">
    <a class="gestionMatiere" href="gestionMatiere.php">Gestion des Matière</a>
    <a class="gestionProjet" href="gestionProjet.php">Gestion des Projets</a>
    <a class="debitMatiere" href="debitMatiere.php">Débit de Matière</a>
    <a class="commandMatiere" href="commandeMatiere.php">Commande de Matière</a>
    <a class="account" href="#"><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></a>
</div>

<div class="content">
    <h2 style="text-align: center">Historique</h2>
    <br>

    <table id="historique">
        <thead>
            <tr>
                <th>Date</th>
                <th>quantité</th>
                <th>Pièce</th>
                <th>Utilisateur</th>
                <th>Classe</th>
                <th>Matière</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $req = $conn->conbdd()->query("SELECT * FROM debit");
        $res = $req->fetchAll();

        foreach ($res as $debit) {
        ?>
            <tr>
                <td><?= $debit['date'] ?></td>
                <td><?= $debit['quantite'] . " m" ?></td>
                <?php
                    $requete = $conn->conbdd()->prepare("SELECT nom FROM piece WHERE id_piece = :id");
                    $requete->execute(['id'=>$debit['ref_piece']]);
                    $resultat = $requete->fetch();
                ?>
                <td><?= $resultat['nom'] ?></td>
                <?php
                $requete = $conn->conbdd()->prepare("SELECT nom, prenom FROM user WHERE id_user = :id");
                $requete->execute(['id'=>$debit['ref_user']]);
                $resultat = $requete->fetch();
                ?>
                <td><?= $resultat['nom'] . " " . $resultat['prenom'] ?></td>
                <?php
                $requete = $conn->conbdd()->prepare("SELECT libelle FROM classe WHERE id_classe = :id");
                $requete->execute(['id'=>$debit['ref_classe']]);
                $resultat = $requete->fetch();
                ?>
                <td><?= $resultat['libelle'] ?></td>
                <?php
                $requete = $conn->conbdd()->prepare("SELECT ref_materiau, ref_forme FROM matiere WHERE id_matiere = :id");
                $requete->execute(['id'=>$debit['ref_matiere']]);
                $resultat = $requete->fetch();

                $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
                $requete->execute(['id' => $resultat['ref_materiau']]);
                $result = $requete->fetch();
                $materiau = $result['libelle'];

                $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
                $requete->execute(['id' => $resultat['ref_forme']]);
                $result = $requete->fetch();
                $forme = $result['libelle'];
                ?>
                <td><?= $forme . " " . $materiau ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready( function () {
        $('#historique').DataTable();
    } );
</script>
</body>
</html>