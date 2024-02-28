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
    <a href="gestionMatiere.php">Gestion des Matière</a>
    <a href="#">Gestion des Projets</a>
    <a href="#">Débit de Matière</a>
    <a href="#">Commande de Matière</a>
    <a class="account" href="#"><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></a>
</div>

<div class="side-bar-action">
    <a href="#">Ajouter</a>
    <br>
    <h4 class="side-bar-title">Trier</h4>
    <a href="#">tt</a>
</div>

<div class="content">
<?php
$req = $conn->conbdd()->query("SELECT * FROM matiere");
$res = $req->fetchAll();

foreach ($res as $matiere) {
    ?>
    <div class="case">
        <h5><?php
            $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
            $requete->execute(['id' => $matiere['ref_materiau']]);
            $result = $requete->fetch();
            $materiau = $result['libelle'];

            $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
            $requete->execute(['id' => $matiere['ref_forme']]);
            $result = $requete->fetch();
            $forme = $result['libelle'];

            echo $forme . " en " . $materiau;
            ?></h5>
        <p><?= $matiere['longueur'] . "cm"?></p>
        <a class="case-edit" href="#">Modifier</a>
        <a class="case-delete" href="#">Supprimer</a>
    </div>
<?php
}
?>
</div>
</body>
</html>
