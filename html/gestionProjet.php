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

$req = $conn->conbdd()->query("SELECT * FROM projet");
$resProjet = $req->fetchAll();
?>
<div class="side-bar-big">
    <a href="gestionMatiere.php">Gestion des Matière</a>
    <a href="gestionProjet.php">Gestion des Projets</a>
    <a href="debitMatiere.php">Débit de Matière</a>
    <a href="#">Commande de Matière</a>
    <a class="account" href="#"><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></a>
</div>

<div class="side-bar-action">
    <a onclick="afficher()">Ajouter Projet</a>
    <a onclick="afficherPiece()">Ajouter Pièce</a>

</div>

<div id="modal-add-projet" class="modal">
    <form action="../php/projet/projet.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1>Ajouter un Projet</h1>
            <span class="close">&times;</span>
        </div>
        <div class="modal-content">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept=".jpeg, .jpg, .png, .jifi" onchange="previewImage()" required>
            <img id="preview" alt="Image Preview">
            <br>
            <input type="text" name="nouveauNom" placeholder="Nom de du projet" required>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>

<div id="modal-add-piece" class="modal">
    <form action="../php/projet/piece/piece.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1>Ajouter une Pièce</h1>
            <span class="close-piece">&times;</span>
        </div>
        <div class="modal-content">
            <input type="text" name="nouveauNom" placeholder="Nom de la pièce" required>
            <br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept=".jpeg, .jpg, .png, .jifi" onchange="previewImage()" required>
            <img id="preview" alt="Image Preview">
            <select name="matiere" required>
                <?php
                $req = $conn->conbdd()->query("SELECT * FROM matiere");
                $res = $req->fetchAll();

                foreach ($res as $matiere) {
                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
                    $requete->execute(['id' => $matiere['ref_materiau']]);
                    $result = $requete->fetch();
                    $materiau = $result['libelle'];

                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
                    $requete->execute(['id' => $matiere['ref_forme']]);
                    $result = $requete->fetch();
                    $forme = $result['libelle'];
                ?>
                <option name="matiere" value="<?=$matiere['id_matiere']?>"><?=$forme . " en " . $materiau?></option>
                <?php }?>
            </select>

            <input type="text" placeholder="longueur" name="longueur">

            <select name="projet" required>
                <?php
                foreach ($resProjet as $projet) {
                    ?>
                    <option name="projet" value="<?=$projet['id_projet']?>"><?=$projet['nom']?></option>
                <?php }?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>

<div class="content">
    <?php
    foreach ($resProjet as $projet) {
    ?>
    <div class="case" onclick="">
        <h5><?=$projet["nom"]?></h5>
        <img src="projetLestrelin/<?= $projet["img"]?>" style="width: 50%; height: 50%">
    </div>
    <?php }?>
</div>

<script type="text/javascript">
    var modalProjet = document.getElementById("modal-add-projet");
    var modalPiece = document.getElementById("modal-add-piece");

    var span = document.getElementsByClassName("close")[0];
    var spanPiece = document.getElementsByClassName("close-piece")[0];

    function afficher() {
        modalProjet.style.display = "block";
    }

    function afficherPiece() {
        modalPiece.style.display = "block";
    }

    span.onclick = function() {
        modalProjet.style.display = "none";
    }

    spanPiece.onclick = function () {
        modalPiece.style.display = "none"
    }

    window.onclick = function(event) {
        if (event.target == modalProjet) {
            modalProjet.style.display = "none";
        } else if (event.target == modalPiece) {
            modalPiece.style.display = "none";
        }
    }

    function previewImage() {
        var preview = document.getElementById('preview');
        var fileInput = document.getElementById('image');
        var file = fileInput.files[0];

        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
</body>
</html>

