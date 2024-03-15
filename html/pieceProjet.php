<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
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

//session_start();
$conn = new SQLConnexion();
//
//if (isset($_SESSION['id_user'])) {
//    $id_user = $_SESSION['id_user'];
//} else {
//    header("Location: ../html/connexion.html");
//}
$req = $conn->conbdd()->query("SELECT * FROM piece");
$respieces = $req->fetchAll();

if (isset($_GET['id'])) {
    $projet_id = $_GET['id'];
    $req_projet = $conn->conbdd()->prepare("SELECT * FROM projet WHERE id_projet = ?");
    $req_projet->execute([$projet_id]);
    $projet = $req_projet->fetch();
    $nom_projet = $projet['nom'];
}else{
    echo "Ce projet n'existe pas !!";
}

?>
?>
<div class="side-bar-big">
    <a class="gestionMatiere" href="gestionMatiere.php">Gestion des Matière</a>
    <a class="gestionProjet" href="gestionProjet.php">Gestion des Projets</a>
    <a class="debitMatiere" href="debitMatiere.php">Débit de Matière</a>
    <a class="commandMatiere" href="commandeMatiere.php">Commande de Matière</a>
    <a class="account" href="#"><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></a>
</div>

<h1>Pieces du Projet<?php echo $nom_projet;?></h1>

<div class="content" style="">
    <?php foreach ($respieces as $piece) {?>
        <div class="case">
                <h5><?=$piece["nom"]?></h5>
                <img src="projetLestrelin/<?= $piece["img"]?>" alt="<?= $piece['img']?>">
        </div>
    <?php }?>
</div>

</body>