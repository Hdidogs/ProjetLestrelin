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
<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 250px; height: 100%; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4"><i class="fa-solid fa-cubes-stacked"></i> Gestion de Stock</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="gestionMatiere.php" class="btn btn-danger" aria-current="page" style="width: 200px">
                Gestion des Matière
            </a>
        </li>
        <br>
        <li>
            <a href="gestionProjet.php" class="btn btn-success" style="width: 200px">
                Gestion des Projets
            </a>
        </li>
        <br>
        <li>
            <a href="debitMatiere.php"" class="btn btn-warning" style="width: 200px">
            Débit de Matière
            </a>
        </li>
        <br>
        <li>
            <a href="commandeMatiere.php" class="btn btn-primary" style="width: 200px">
                Commande de Matière
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/hdidogs.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></strong>
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>

<div class="side-bar-action">
    <a onclick="afficher()">Ajouter Projet</a>
    <a onclick="afficherPiece()">Ajouter Pièce</a>

</div>

<div id="modal-add-projet" class="modal" style="max-height: 400px; overflow-y: auto;">
    <form action="../php/projet/projet.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1>Ajouter un Projet</h1>
            <span class="close">&times;</span>
        </div>
        <div class="modal-content modal-content-scrollable">
            <label for="imageProjet">Image:</label>
            <input type="file" id="imageProjet" name="image" accept=".jpeg, .jpg, .png, .jifi" onchange="previewImage('previewProjet')" required>
            <img id="previewProjet" alt="Image Preview">
            <br>
            <input type="text" name="nouveauNom" placeholder="Nom du projet" required>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>

<div id="modal-add-piece" class="modal" style="max-height: 400px; overflow-y: auto;">
    <form action="../php/projet/piece/piece.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h1>Ajouter une Pièce</h1>
            <span class="close-piece">&times;</span>
        </div>
        <div class="modal-content">
            <input type="text" name="nouveauNom" placeholder="Nom de la pièce" required>
            <br>
            <label for="imagePiece">Image:</label>
            <input type="file" id="imagePiece" name="image" accept=".jpeg, .jpg, .png, .jifi" onchange="previewImage('previewPiece')" required>
            <img id="previewPiece" alt="Image Preview">
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

<div class="content" style="">
    <?php
    foreach ($resProjet as $projet) {
    ?>
    <div class="case" onclick="">
        <h5><?=$projet["nom"]?></h5>
        <img src="projetLestrelin/<?= $projet["img"]?>">
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

    function previewImage(previewId) {
        var preview = document.getElementById(previewId);
        var fileInput = document.getElementById(previewId === 'previewProjet' ? 'imageProjet' : 'imagePiece');

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