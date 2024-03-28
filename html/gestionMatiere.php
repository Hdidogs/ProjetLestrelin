<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="../css/styles.css"/>
</head>
<body>
<<<<<<< HEAD
=======
<div>
>>>>>>> bded785111861ea90c17cdc577201fc4f30f5c64
<?php
// Inclure le fichier de connexion à la base de données
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
    <a href="?addMatiere=true">Ajouter Matière</a>
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
        <h5 class="card-title"><?php
            $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = ?");
            $requete->execute([$matiere['ref_materiau']]);
            $result = $requete->fetch();
            $materiau = $result['libelle'];

            $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = ?");
            $requete->execute([$matiere['ref_forme']]);
            $result = $requete->fetch();
            $forme = $result['libelle'];

            echo $forme . " en " . $materiau;
            ?></h5>
        <?php if (!empty($matiere['longueur'])) { ?>
            <p class="card-text">Longueur: <?= $matiere['longueur'] ?>cm</p>
        <?php } ?>
        <?php if (!empty($matiere['hauteur'])) { ?>
            <p class="card-text">Hauteur: <?= $matiere['hauteur'] ?>cm</p>
        <?php } ?>
        <?php if (!empty($matiere['epaisseur'])) { ?>
            <p class="card-text">Épaisseur: <?= $matiere['epaisseur'] ?>cm</p>
        <?php } ?>
        <?php if (!empty($matiere['largeur'])) { ?>
            <p class="card-text">Largeur: <?= $matiere['largeur'] ?>cm</p>
        <?php } ?>
        <?php if (!empty($matiere['diametre'])) { ?>
            <p class="card-text">Diamètre: <?= $matiere['diametre'] ?>cm</p>
        <?php } ?>
        <input type="hidden" name="id" value="<?= $matiere['id_matiere'] ?>">
        <a id="btn-edit" onclick="afficher(<?= $matiere['id_matiere'] ?>)" class="case-edit">Modifier</a>
        <a id="btn-delete" onclick="afficherSupprimer(<?= $matiere['id_matiere'] ?>)" class="case-delete">Supprimer</a>
        </div>
<<<<<<< HEAD
        <?php
=======

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
>>>>>>> bded785111861ea90c17cdc577201fc4f30f5c64
        }
        ?>
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
                    <!-- Contenu du formulaire pour ajouter une matière -->
                </div>
                <div class="modal-footer">
                    <button type="reset">Réinitialiser</button>
                    <button name="add" type="submit">Ajouter</button>
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
                        <input type="text" name="libelle" placeholder="Libellé">
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
                        <?php
                        // Vérifier si le formulaire d'ajout de forme a été soumis
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addForme"])) {
                            // Logique pour ajouter une nouvelle forme
                            $libelle = $_POST['libelle'];
                            $longueur = $_POST['longueur'];
                            $largeur = $_POST['largeur'];
                            $epaisseur = $_POST['epaisseur'];
                            $diametre = $_POST['diametre'];
                            $hauteur = $_POST['hauteur'];
                            try {
                                // Préparer la requête SQL d'insertion dans la table "forme"
                                $stmt = $conn->conbdd()->prepare("INSERT INTO forme (libelle, longueur, largeur, epaisseur, diametre, hauteur) VALUES (?, ?, ?, ?, ?, ?)");
                                // Vérifier si la préparation de la requête a réussi
                                if ($stmt) {
                                    // Binder les valeurs aux paramètres de la requête
                                    $stmt->bindParam(1, $libelle);
                                    $stmt->bindParam(2, $longueur);
                                    $stmt->bindParam(3, $largeur);
                                    $stmt->bindParam(4, $epaisseur);
                                    $stmt->bindParam(5, $diametre);
                                    $stmt->bindParam(6, $hauteur);

                                    // Exécuter la requête
                                    if ($stmt->execute()) {
                                        // Afficher un message de succès
                                        // echo "<script>alert('Nouvelle forme ajoutée avec succès.');</script>";
                                    } else {
                                        // Afficher un message d'erreur en cas d'échec de l'insertion
                                        // echo "<script>alert('Erreur lors de l\'ajout de la nouvelle forme : " . $stmt->errorInfo()[2] . "');</script>";
                                    }

                                    // Fermer la requête
                                    $stmt = null;
                                    } else {
                                        // Afficher un message d'erreur en cas d'échec de la préparation de la requête
                                        // echo "<script>alert('Erreur lors de la préparation de la requête : " . $conn->conbdd()->errorInfo()[2] . "');</script>";
                                    }
                                    } catch (PDOException $e) {
                                        // Afficher un message d'erreur en cas d'exception PDO
                                        // echo "<script>alert('Erreur PDO : " . $e->getMessage() . "');</script>";
                                    }
                                    }
                                    ?>
                                    <?php
                                    // Vérifier si le formulaire d'ajout de matériau a été soumis
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addMateriau"])) {
                                        // Récupérer les données du formulaire
                                        if(isset($_POST['libelleMateriau']) && !empty(trim($_POST['libelleMateriau']))) {
                                            $libelle = trim($_POST['libelle']);

                                            // Créer une instance de la connexion à la base de données
                                            $conn = new SQLConnexion();

                                            // Préparer la requête SQL d'insertion
                                            $stmt = $conn->conbdd()->prepare("INSERT INTO materiau (libelle) VALUES (?)");

                                            // Vérifier si la préparation de la requête a réussi
                                            if ($stmt) {
                                                // Binder les valeurs aux paramètres de la requête
                                                $stmt->bindParam(1, $libelle);

                                                // Exécuter la requête
                                                if ($stmt->execute()) {
                                                    // Afficher un message de succès
                                                    // echo "<script>alert('Nouveau matériau ajouté avec succès.');</script>";
                                                } else {
                                                    // Afficher un message d'erreur en cas d'échec de l'insertion
                                                    // echo "<script>alert('Erreur lors de l\'ajout du nouveau matériau : " . $stmt->errorInfo()[2] . "');</script>";
                                                }

                                                // Fermer la requête
                                                $stmt = null;

                                            } else {
                                                // Afficher un message d'erreur en cas d'échec de la préparation de la requête
                                                // echo "<script>alert('Erreur lors de la préparation de la requête : " . $conn->conbdd()->errorInfo()[2] . "');</script>";
                                            }

                                            // Fermer la connexion à la base de données
                                            $conn = null;
                                        } else {
                                            // Afficher un message d'erreur si le champ libelle est vide
                                            // echo "<script>alert('Erreur : Le champ libelle ne peut pas être vide.');</script>";
                                        }
                                    } else {
                                        // Rediriger vers une page d'erreur ou afficher un message d'erreur si le formulaire n'a pas été soumis correctement
                                        // echo "<script>alert('Erreur : Le formulaire n\'a pas été soumis correctement.');</script>";
                                    }
                                    ?>

                                    <script type="text/javascript">
                                    // JavaScript pour gérer l'affichage des modals et leur fermeture
                                    var modalAjouter = document.getElementById("modal-ajouter");
                                    var modalNouvelleForme = document.getElementById("modal-nouvelle-forme");
                                    var modalNouveauMateriau = document.getElementById("modal-nouveau-materiau");

                                    var spanAjouter = document.getElementsByClassName("close-ajouter")[0];
                                    var spanNouvelleForme = document.getElementsByClassName("close-nouvelle-forme")[0];
                                    var spanNouveauMateriau = document.getElementsByClassName("close-nouveau-materiau")[0];

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
                                    spanAjouter.onclick = function() {
                                        modalAjouter.style.display = "none";
                                    }

                                    // Fonction pour fermer le modal pour ajouter une nouvelle forme
                                    spanNouvelleForme.onclick = function() {
                                        modalNouvelleForme.style.display = "none";
                                    }

                                    // Fonction pour fermer le modal pour ajouter un nouveau matériau
                                    spanNouveauMateriau.onclick = function() {
                                        modalNouveauMateriau.style.display = "none";
                                    }

                                    function afficher(id) {
                                        // Récupérer les informations de la matière en fonction de son identifiant unique
                                        var matiere = document.getElementById('matiere' + id);

                                        // Afficher les informations dans une alerte (vous pouvez personnaliser cette partie selon vos besoins)
                                        // alert("Informations sur la matière :\n" + matiere.innerHTML);
                                    }

                                    // Fermer le modal lorsqu'on clique en dehors de la fenêtre modale
                                    window.onclick = function(event) {
                                        if (event.target == modalAjouter) {
                                            modalAjouter.style.display = "none";
                                        } else if (event.target == modalNouvelleForme) {
                                            modalNouvelleForme.style.display = "none";
                                        } else if (event.target == modalNouveauMateriau) {
                                            modalNouveauMateriau.style.display = "none";
                                        }
                                    }

                                    // Fonction pour préremplir les champs texte lors du clic sur le bouton "Modifier"
                                    function prefillFields() {
                                        var libelle = "Valeur du libellé";
                                        var longueur = "Valeur de la longueur";
                                        var largeur = "Valeur de la largeur";
                                        var epaisseur = "Valeur de l'épaisseur";
                                        var diametre = "Valeur du diamètre";
                                        var hauteur = "Valeur de la hauteur";

                                        document.getElementsByName("libelle")[0].value = libelle;
                                        document.getElementsByName("longueur")[0].value = longueur;
                                        document.getElementsByName("largeur")[0].value = largeur;
                                        document.getElementsByName("epaisseur")[0].value = epaisseur;
                                        document.getElementsByName("diametre")[0].value = diametre;
                                        document.getElementsByName("hauteur")[0].value = hauteur;
                                    }

                                    // Appeler la fonction pour préremplir les champs texte lors du chargement de la page
                                    window.onload = function() {
                                        prefillFields();
                                    }
                                    </script>

                                    </body>
                                    </html>
