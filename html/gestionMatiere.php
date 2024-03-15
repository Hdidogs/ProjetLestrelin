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
<div>
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

<div class="side-bar-action">
    <a>Ajouter Matière</a>
    <a>Nouvelle Forme</a>
    <a>Nouveau Matériau</a>
    <br>
    <h4 class="side-bar-title">Trier</h4>
</div>
<div class="content">
<?php
$req = $conn->conbdd()->query("SELECT * FROM matiere");
$res = $req->fetchAll();

foreach ($res as $matiere) {
    ?>
    <div class="case card">
        <h5 class="card-title"><?php
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
        <p class="card-text"><?= $matiere['longueur'] . "Cm"?></p>
        <input type="hidden" name="id" value="<?=$matiere['id_matiere']?>">

        <a id="btn-edit" onclick="afficher(<?=$matiere['id_matiere']?>)" class="case-edit">Modifier</a>
        <a id="btn-delete" onclick="afficherSupprimer(<?=$matiere['id_matiere']?>)" class="case-delete">Supprimer</a>
    </div>
<?php
}
?>
    </div>
</div>

<!-- Modals -->
<!-- Supprimer/Modifier -->

<div id="modal-edit" class="modal">
    <form method="get" action="../php/matiere/traitementMatiere.php">
        <div class="modal-header">
            <h1>Modifier</h1>
            <span class="close">&times;</span>
        </div>

        <input id="modifId" name="id" >
        <div class="modal-content">
            <p>test</p>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button name="edit" type="submit">Modifier</button>
        </div>
    </form>
</div>

<div id="modal-suppr" class="modal">
    <form method="get" action="../php/matiere/traitementMatiere.php">
        <div class="modal-header">
            <h1>Supprimer</h1>
            <span class="close-supprimer">&times;</span>
        </div>

        <input type="hidden" id="supprId" name="id" >
        <div class="modal-content">
            <p>Êtes vous sûr de vouloir supprimer cette matière ?
            Seul supprimeras en même temps toute historique lier a cette matière !</p>
        </div>
        <div class="modal-footer">
            <button class="close" type="button">Non</button>
            <button name="suppr" type="submit">Oui</button>
        </div>
    </form>
</div>

<!-- Ajouter -->

<div id="modal-ajouter" class="modal">
    <form method="get" action="../php/matiere/traitementMatiere.php">
        <div class="modal-header">
            <h1>Ajouter</h1>
            <span class="close-ajouter">&times;</span>
        </div>
        <div class="modal-content">
            <select>
                <?php
                $req = $conn->conbdd()->query("SELECT * FROM materiau");
                $res = $req->fetchAll();

                foreach ($res as $materiau) {
                ?>
                <option><?=$materiau['libelle']?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button name="add" type="submit">Ajouter</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    var modal = document.getElementById("modal-edit");
    var modalAjouter = document.getElementById("modal-edit");
    var modalSupprimer = document.getElementById("modal-suppr");

    var span = document.getElementsByClassName("close")[0];
    var spanAjouter = document.getElementsByClassName("close-ajouter")[0];
    var spanSupprimer = document.getElementsByClassName("close-supprimer")[0];

    function afficher(id) {
        modal.style.display = "block";

        $("#modifId").val(id)

        // Centrer la pop-up au milieu de l'écran
        modal.style.transform = "translate(-50%, -50%)";
        modal.style.top = "50%";
        modal.style.left = "50%";
    }

    function afficherSupprimer(id) {
        modalSupprimer.style.display = "block";

        $("#supprId").val(id)
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    spanAjouter.onclick = function() {
        modalAjouter.style.display = "none";
    }

    spanSupprimer.onclick = function() {
        modalSupprimer.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (event.target == modalSupprimer) {
            modalSupprimer.style.display = "none";
        } else if (event.target == modalAjouter) {
            modalAjouter.style.display = "none";
        }
    }
</script>
</body>
</html>