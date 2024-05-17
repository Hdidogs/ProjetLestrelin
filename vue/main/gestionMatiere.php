<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <x></x>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/styles.css" />
    <link rel="stylesheet" href="../../assets/css/IndexStyle.css" />

    <!-- JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include '../../src/bdd/SqlConnexion.php';

    session_start();
    $conn = new SQLConnexion();

    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];
    } else {
        header("Location: connexion.html");
    }
    ?>
    <div class="offcanvas offcanvas-start bg-body show visible" tabindex="-1" data-bs-backdrop="false"
        id="offcanvas-menu" style="width: 260px">
        <div class="offcanvas-header">
            <a class="link-body-emphasis d-flex align-items-center me-md-auto mb-3 mb-md-0 text-decoration-none"
                href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                    class="bi bi-box-seam me-3" style="font-size: 25px;">
                    <path
                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z">
                    </path>
                </svg>
                <span class="fs-4">Gestion de Stock</span>
            </a>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between pt-0">
            <div>
                <hr class="mt-0">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link active link-light" href="gestionMatiere.php" aria-current="page"
                            style="background: var(--bs-red);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-house-door me-2">
                                <path
                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z">
                                </path>
                            </svg> Gestion de Matière
                        </a>
                    </li>
                    <br>
                    <li class="nav-item"><a class="nav-link" href="gestionProjet.php"
                            style="color: var(--bs-nav-pills-link-active-color);background: var(--bs-form-valid-border-color);"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-speedometer2 me-2">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3">
                                </path>
                            </svg> Gestion de Projet</a></li>
                    <br>
                    <li class="nav-item"><a class="nav-link" href="debitMatiere.php"
                            style="background: var(--bs-yellow);color: var(--bs-nav-pills-link-active-color);"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-calendar-plus me-2">
                                <path
                                    d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7">
                                </path>
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z">
                                </path>
                            </svg> Débit de Matière</a></li>
                    <br>
                    <li class="nav-item"><a class="nav-link" href="commandeMatiere.php"
                            style="background: var(--bs-nav-pills-link-active-bg);color: var(--bs-nav-pills-link-active-color);"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-grid me-2">
                                <path
                                    d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z">
                                </path>
                            </svg> Commande de Matière</a></li>
                    <li class="nav-item"></li>
                </ul>
            </div>
            <div>
                <hr>
                <div class="dropdown">
                    <a class="dropdown-toggle link-body-emphasis d-flex align-items-center text-decoration-none"
                        aria-expanded="false" data-bs-toggle="dropdown" role="button"><img class="rounded-circle me-2"
                            alt="" width="32" height="32" src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"
                            style="object-fit: cover;">
                        <strong><?= $_SESSION['nom'] . " " . $_SESSION['prenom'] ?></strong>&nbsp;
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
        <a href="#modal-ajouter" onclick="afficherModalAjouter()">Ajouter Matière</a>
        <a href="#modal-nouvelle-forme" onclick="afficherModalNouvelleForme()">Nouvelle Forme</a>
        <a href="#modal-nouveau-materiau" onclick="afficherModalNouveauMateriau()">Nouveau Matériau</a>

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
                <h5 class="card-title">
                    <?php
                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = ?");
                    $requete->execute([$matiere['ref_materiau']]);
                    $result = $requete->fetch();
                    $materiau = $result['libelle'];

                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = ?");
                    $requete->execute([$matiere['ref_forme']]);
                    $result = $requete->fetch();
                    $forme = $result['libelle'];

                    echo $forme . " en " . $materiau;
                    ?>
                </h5>
                <?php if (!empty($matiere['longueur'])) { ?>
                    <p class="card-text">Longueur:
                        <?= $matiere['longueur'] ?>cm
                    </p>
                <?php } ?>
                <?php if (!empty($matiere['hauteur'])) { ?>
                    <p class="card-text">Hauteur:
                        <?= $matiere['hauteur'] ?>cm
                    </p>
                <?php } ?>
                <?php if (!empty($matiere['epaisseur'])) { ?>
                    <p class="card-text">Épaisseur:
                        <?= $matiere['epaisseur'] ?>cm
                    </p>
                <?php } ?>
                <?php if (!empty($matiere['largeur'])) { ?>
                    <p class="card-text">Largeur:
                        <?= $matiere['largeur'] ?>cm
                    </p>
                <?php } ?>
                <?php if (!empty($matiere['diametre'])) { ?>
                    <p class="card-text">Diamètre:
                        <?= $matiere['diametre'] ?>cm
                    </p>
                <?php } ?>
                <input type="hidden" name="id" value="<?= $matiere['id_matiere'] ?>">
                <a id="btn-edit" onclick="afficher(<?= $matiere['id_matiere'] ?>)" class="case-edit">Modifier</a>
                <a id="btn-delete" onclick="afficherSupprimer(<?= $matiere['id_matiere'] ?>)"
                    class="case-delete">Supprimer</a>

            </div>
            <?php
        }
        ?>
    </div>
        <!-- Modals Formulaire -->
        <!-- Ajouter  -->
        <div id="modal-ajouter" class="modal">
            <form method="post" action="../../src/controleur/matiere/TraitementMatiere.php">
                <div class="modal-header">
                    <h1>Ajouter</h1>
                    <span class="close-ajouter">&times;</span>
                </div>
                <div class="modal-content">
                    <select name="materiau" id="materiau">
                        <option value="">Sélectionner un matériau</option>
                        <?php
                        $requete = $conn->conbdd()->query("SELECT * FROM materiau");
                        $result = $requete->fetchAll();
                        foreach ($result as $materiau) {
                            echo "<option value='" . $materiau['id_materiau'] . "'>" . $materiau['libelle'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="forme" id="forme">
                        <option value="">Sélectionner une forme</option>
                        <?php
                        $requete = $conn->conbdd()->query("SELECT * FROM forme");
                        $result = $requete->fetchAll();
                        foreach ($result as $forme) {
                            echo "<option value='" . $forme['id_forme'] . "'>" . $forme['libelle'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="text" name="longueur" placeholder="Longueur">
                    <input type="text" name="largeur" placeholder="Largeur">
                    <input type="text" name="epaisseur" placeholder="Épaisseur">
                    <input type="text" name="diametre" placeholder="Diamètre">
                    <input type="text" name="hauteur" placeholder="Hauteur">
                </div>
            </form>
        </div>


            <!-- Nouvelle Forme -->
            <div id="modal-nouvelle-forme" class="modalJS">
                <form method="post" action="">
                    <div class="modal-header">
                        <h1>Nouvelle Forme</h1>
                        <span class="close-nouvelle-forme">&times;</span>
                    </div>
                    <div class="modal-content">
                        <!-- Contenu du formulaire pour ajouter une nouvelle forme -->
                        <input type="text" name="libelle" placeholder="Nom de la forme">
                        <input type="text" name="longueur" placeholder="Longueur">
                        <input type="text" name="largeur" placeholder="Largeur">
                        <input type="text" name="epaisseur" placeholder="Épaisseur">
                        <input type="text" name="diametre" placeholder="Diamètre">
                        <input type="text" name="hauteur" placeholder="Hauteur">
                    </div>
                    <div class="modal-footer">
                        <button type="reset">Réinitialiser</button>
                        <button name="addForme" type="submit">Ajouter</button>
                    </div>
                </form>
            </div>

            <!-- Nouveau Matériau -->
            <div id="modal-nouveau-materiau" class="modalJS">
                <form method="post" action="">
                    <div class="modal-header">
                        <h1>Nouveau Matériau</h1>
                        <span class="close-nouveau-materiau">&times;</span>
                    </div>
                    <div class="modal-content">
                        <input type="text" name="libelleMateriau" placeholder="Libellé">
                    </div>
                    <div class="modal-footer">
                        <button type="reset">Réinitialiser</button>
                        <button name="addMateriau" type="submit">Ajouter</button>
                    </div>


                    <!-- Modals -->
                    <!-- Ajouter Matière -->
                    <div id="modal-ajouter" class="modalJS">
                        <form method="post" action="../php/matiere/traitementMatiere.php">
                            <div class="modal-header">
                                <h1>Ajouter</h1>
                                <span class="close-ajouter">&times;</span>
                            </div>
                            <div class="modal-content">
                                <select name="materiau" id="materiau">
                                    <option value="">Sélectionner un matériau</option>
                                    <?php
                                    $requete = $conn->conbdd()->query("SELECT * FROM materiau");
                                    $result = $requete->fetchAll();
                                    foreach ($result as $materiau) {
                                        echo "<option value='" . $materiau['id_materiau'] . "'>" . $materiau['libelle'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <select name="forme" id="forme">
                                    <option value="">Sélectionner une forme</option>
                                    <?php
                                    $requete = $conn->conbdd()->query("SELECT * FROM forme");
                                    $result = $requete->fetchAll();
                                    foreach ($result as $forme) {
                                        echo "<option value='" . $forme['id_forme'] . "'>" . $forme['libelle'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="text" name="longueur" placeholder="Longueur">
                                <input type="text" name="largeur" placeholder="Largeur">
                                <input type="text" name="epaisseur" placeholder="Épaisseur">
                                <input type="text" name="diametre" placeholder="Diamètre">
                                <input type="text" name="hauteur" placeholder="Hauteur">
                            </div>
                <div class="modal-footer">
                    <button type="reset">Réinitialiser</button>
                    <button name="addnewMatiere" type="submit">Ajouter</button>
                </div>
            </form>
        </div>

        <!-- Nouvelle Forme -->
        <div id="modal-nouvelle-forme" class="modal">
            <form method="post" action="">
                <div class="modal-header">
                    <h1>Nouvelle Forme</h1>
                    <span class="close-nouvelle-forme">&times;</span>
                </div>
                <div class="modal-content">
                    <!-- Contenu du formulaire pour ajouter une nouvelle forme -->
                    <input type="text" name="libelle" placeholder="Nom de la forme">
                    <input type="text" name="longueur" placeholder="Longueur">
                    <input type="text" name="largeur" placeholder="Largeur">
                    <input type="text" name="epaisseur" placeholder="Épaisseur">
                    <input type="text" name="diametre" placeholder="Diamètre">
                    <input type="text" name="hauteur" placeholder="Hauteur">
                </div>
                <div class="modal-footer">
                    <button type="reset">Réinitialiser</button>
                    <button name="addForme" type="submit">Ajouter</button>
                </div>
            </form>
        </div>

        <!-- Nouveau Matériau -->
        <div id="modal-nouveau-materiau" class="modal">
            <form method="post" action="">
                <div class="modal-header">
                    <h1>Nouveau Matériau</h1>
                    <span class="close-nouveau-materiau">&times;</span>
                </div>
                <div class="modal-content">
                    <input type="text" name="libelleMateriau" placeholder="Libellé">
                </div>
                <div class="modal-footer">
                    <button type="reset">Réinitialiser</button>
                    <button name="addMateriau" type="submit">Ajouter</button>
                </div>


                <!-- Modals -->
                <!-- Ajouter Matière -->
                <div id="modal-ajouter" class="modal">
                    <form method="post" action="../php/matiere/traitementMatiere.php">
                        <div class="modal-header">
                            <h1>Ajouter</h1>
                            <span class="close-ajouter">&times;</span>
                        </div>
                        <div class="modal-content">
                            <select name="materiau" id="materiau">
                                <option value="">Sélectionner un matériau</option>
                                <?php
                                $requete = $conn->conbdd()->query("SELECT * FROM materiau");
                                $result = $requete->fetchAll();
                                foreach ($result as $materiau) {
                                    echo "<option value='" . $materiau['id_materiau'] . "'>" . $materiau['libelle'] . "</option>";
                                }
                                ?>
                            </select>
                            <select name="forme" id="forme">
                                <option value="">Sélectionner une forme</option>
                                <?php
                                $requete = $conn->conbdd()->query("SELECT * FROM forme");
                                $result = $requete->fetchAll();
                                foreach ($result as $forme) {
                                    echo "<option value='" . $forme['id_forme'] . "'>" . $forme['libelle'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="text" name="longueur" placeholder="Longueur">
                            <input type="text" name="largeur" placeholder="Largeur">
                            <input type="text" name="epaisseur" placeholder="Épaisseur">
                            <input type="text" name="diametre" placeholder="Diamètre">
                            <input type="text" name="hauteur" placeholder="Hauteur" </div>
>>>>>>> 5a0d7e6c12d1e0d867439f3c32b3dbb1c1cf68e6
                            <div class="modal-footer">
                                <button type="reset">Réinitialiser</button>
                                <button name="add" type="submit">Ajouter</button>
                            </div>
                    </form>
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addMateriau'])) {
                    $libelleMateriau = $_POST['libelleMateriau'];
                    $requete = $conn->conbdd()->prepare("INSERT INTO materiau (libelle) VALUES (?)");
                    $requete->execute([$libelleMateriau]);
                }



                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addForme'])) {
                    $libelle = $_POST['libelle'];
                    $longueur = $_POST['longueur'];
                    $largeur = $_POST['largeur'];
                    $epaisseur = $_POST['epaisseur'];
                    $diametre = $_POST['diametre'];
                    $hauteur = $_POST['hauteur'];

                    $requete = $conn->conbdd()->prepare("INSERT INTO forme (libelle, longueur, largeur, epaisseur, diametre, hauteur) VALUES (?, ?, ?, ?, ?, ?)");
                    $requete->execute([$libelle, $longueur, $largeur, $epaisseur, $diametre, $hauteur]);
                }
                ?>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        // JavaScript pour gérer l'affichage des modals et leur fermeture
        var modalAjouter = document.getElementById("modal-ajouter");
        var modalNouvelleForme = document.getElementById("modal-nouvelle-forme");
        var modalNouveauMateriau = document.getElementById("modal-nouveau-materiau");

        var spanAjouter = document.getElementsByClassName("close-ajouter")[0];
        var spanNouvelleForme = document.getElementsByClassName("close-nouvelle-forme")[0];
        var spanNouveauMateriau = document.getElementsByClassName("close-nouveau-materiau")[0];

        function ajouterMatiere() {
            modalAjouter.style.display = "block";
        }

        // Fonction pour afficher le modal pour ajouter une matière
        function afficherModalAjouter() {
            modalAjouter.style.display = "block";
        }

        // Fonction pour afficher le modal pour ajouter une nouvelle forme
        function afficherModalNouvelleForme() {
            modalNouvelleForme.style.display = "block";
        }

        // Fonction pour afficher le modal pour ajouter un nouveau matériau
        function afficherModalNouveauMateriau() {
            modalNouveauMateriau.style.display = "block";
        }

        // Fonction pour fermer le modal pour ajouter une matière
        spanAjouter.onclick = function () {
            modalAjouter.style.display = "none";
        }

        // Fonction pour fermer le modal pour ajouter une nouvelle forme
        spanNouvelleForme.onclick = function () {
            modalNouvelleForme.style.display = "none";
        }

        // Fonction pour fermer le modal pour ajouter un nouveau matériau
        spanNouveauMateriau.onclick = function () {
            modalNouveauMateriau.style.display = "none";
        }

        function afficher(id) {
            // Récupérer les informations de la matière en fonction de son identifiant unique
            var matiere = document.getElementById('matiere' + id);

            // Afficher les informations dans une alerte (vous pouvez personnaliser cette partie selon vos besoins)
            // alert("Informations sur la matière :\n" + matiere.innerHTML);
        }

        // Fermer le modal lorsqu'on clique en dehors de la fenêtre modale
        window.onclick = function (event) {
            if (event.target == modalAjouter) {
                modalAjouter.style.display = "none";
            } else if (event.target == modalNouvelleForme) {
                modalNouvelleForme.style.display = "none";
            } else if (event.target == modalNouveauMateriau) {
                modalNouveauMateriau.style.display = "none";
            }
        }

        // Fonction pour préremplir les champs texte lors du clic sur le bouton "Modifier"


<<<<<<< HEAD
                        // Appeler la fonction pour préremplir les champs texte lors du chargement de la page
                        window.onload = function () {
                            prefillFields();
                        }
                    </script>
=======
        // Appeler la fonction pour préremplir les champs texte lors du chargement de la page
        window.onload = function () {
            prefillFields();
        }
    </script>

>>>>>>> 5a0d7e6c12d1e0d867439f3c32b3dbb1c1cf68e6
</body>

</html>