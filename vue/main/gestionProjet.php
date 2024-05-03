<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Panel de Gestion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../assets/css/styles.css"/>
    <link rel="stylesheet" href="../../assets/css/IndexStyle.css"/>
    <!-- JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<?php
include '../../src/bdd/SQLConnexion.php';

session_start();
$conn = new SQLConnexion();

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: ../main/connexion.html");
}

$req = $conn->conbdd()->query("SELECT * FROM projet");
$resProjet = $req->fetchAll();
?>

<div class="offcanvas offcanvas-start bg-body show visible" tabindex="-1" data-bs-backdrop="false" id="offcanvas-menu" style="width: 260px">
    <div class="offcanvas-header">
        <a class="link-body-emphasis d-flex align-items-center me-md-auto mb-3 mb-md-0 text-decoration-none" href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-box-seam me-3" style="font-size: 25px;">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"></path>
            </svg>
            <span class="fs-4">Gestion de Stock</span>
        </a>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between pt-0">
        <div>
            <hr class="mt-0">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link active link-light" href="gestionMatiere.php" aria-current="page" style="background: var(--bs-red);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-house-door me-2">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"></path>
                        </svg> Gestion de Matière
                    </a>
                </li>
                <br>
                <li class="nav-item"><a class="nav-link" href="gestionProjet.php" style="color: var(--bs-nav-pills-link-active-color);background: var(--bs-form-valid-border-color);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-speedometer2 me-2">
                            <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
                            <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"></path>
                        </svg> Gestion de Projet</a></li>
                <br>
                <li class="nav-item"><a class="nav-link" href="debitMatiere.php" style="background: var(--bs-yellow);color: var(--bs-nav-pills-link-active-color);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-calendar-plus me-2">
                            <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"></path>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"></path>
                        </svg> Débit de Matière</a></li>
                <br>
                <li class="nav-item"><a class="nav-link" href="commandeMatiere.php" style="background: var(--bs-nav-pills-link-active-bg);color: var(--bs-nav-pills-link-active-color);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-grid me-2">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"></path>
                        </svg> Commande de Matière</a></li>
                <li class="nav-item"></li>
            </ul>
        </div>
        <div>
            <hr>
            <div class="dropdown">
                <a class="dropdown-toggle link-body-emphasis d-flex align-items-center text-decoration-none" aria-expanded="false" data-bs-toggle="dropdown" role="button"><img class="rounded-circle me-2" alt="" width="32" height="32" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" style="object-fit: cover;">
                    <strong><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></strong>&nbsp;
                </a>
                <div class="dropdown-menu shadow text-small" data-popper-placement="top-start">
                    <?php
                    if ($_SESSION['fonction'] == 3) {
                        ?>
                        <a class="dropdown-item" href="gestionUser.php">Gestion des Utilisateurs</a>
                        <div class="dropdown-divider"></div>
                        <?php
                    }
                    ?>
                    <form action="../../src/controleur/user/TraitementUser.php" method="post">
                        <button class="dropdown-item" type="submit" name="deconnexion">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="side-bar-action">
    <a onclick="afficher()">Ajouter Projet</a>
    <a onclick="afficherPiece()">Ajouter Pièce</a>

</div>

<div id="modal-add-projet" class="modal" style="max-height: 400px; overflow-y: auto;">
    <form action="../../src/controleur/projet/TraitementProjet.php" method="post" enctype="multipart/form-data">
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
    <form action="../../src/controleur/projet/piece/TraitementPiece.php" method="post" enctype="multipart/form-data">
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
    <div class="case">
        <a href="pieceProjet.php?id=<?=$projet["id_projet"]?>">
        <h5><?=$projet["nom"]?></h5>
        <img src="../../assets/images/<?= $projet["img"]?>"/>
        </a>
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
        if (event.target === modalProjet) {
            modalProjet.style.display = "none";
        } else if (event.target === modalPiece) {
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