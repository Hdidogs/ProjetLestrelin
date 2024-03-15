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
//
//if (isset($_SESSION['id_user'])) {
//    $id_user = $_SESSION['id_user'];
//} else {
//    header("Location: ../html/connexion.html");
//}
?>

<div class="side-bar-big">
    <a class="gestionMatiere" href="gestionMatiere.php">Gestion des Matière</a>
    <a class="gestionProjet" href="gestionProjet.php">Gestion des Projets</a>
    <a class="debitMatiere" href="debitMatiere.php">Débit de Matière</a>
    <a class="commandMatiere" href="commandeMatiere.php">Commande de Matière</a>
    <a class="account" href="#"><?=$_SESSION['nom'] . " " . $_SESSION['prenom']?></a>
</div>

<div class="side-bar-action">
    <a onclick="afficher()">Nouvelle Commande</a>
</div>

<div class="content">
    <h2 style="text-align: center; width: 800px">Historique</h2>
    <br>
    <br>
    <br>
    <table id="historique">
        <thead>
        <tr>
            <th>Date</th>
            <th>Quantité</th>
            <th>Etat</th>
            <th>Numéro de Devis</th>
            <th>Utilisateur</th>
            <th>Classe</th>
            <th>Matière</th>
            <th>Fournisseur</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $req = $conn->conbdd()->query("SELECT * FROM commande");
        $res = $req->fetchAll();

        foreach ($res as $commande) {
        ?>
        <tr>
            <td><?= $commande['date'] ?></td>

            <td><?= $commande['quantite'] . " m" ?></td>

            <td><?= $commande['etat'] ?></td>

            <td><?= $commande['num_devis'] ?></td>

            <?php
            $requete = $conn->conbdd()->prepare("SELECT nom, prenom FROM user WHERE id_user = :id");
            $requete->execute(['id'=>$commande['ref_user']]);
            $resultat = $requete->fetch();
            ?>
            <td><?= $resultat['nom'] . " " . $resultat['prenom'] ?></td>

            <?php
            $requete = $conn->conbdd()->prepare("SELECT libelle FROM classe WHERE id_classe = :id");
            $requete->execute(['id'=>$commande['ref_classe']]);
            $resultat = $requete->fetch();
            ?>
            <td><?= $resultat['libelle'] ?></td>

            <?php
            $requete = $conn->conbdd()->prepare("SELECT ref_materiau, ref_forme FROM matiere WHERE id_matiere = :id");
            $requete->execute(['id'=>$commande['ref_matiere']]);
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

            <?php
            $requete = $conn->conbdd()->prepare("SELECT entreprise FROM fournisseur WHERE id_fournisseur = :id");
            $requete->execute(['id'=>$commande['ref_fournisseur']]);
            $resultat = $requete->fetch();
            ?>
            <td><?= $resultat['entreprise'] ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div id="modal-commande" class="modal">
    <form method="get" action="../php/matiere/traitementMatiere.php">
        <div class="modal-header">
            <h1>Nouvelle Commande</h1>
            <span class="close">&times;</span>
        </div>
        <div class="modal-content">
            <input type="date" name="date" required>
            <input type="number" placeholder="Quantité (m)" name="quantite" required>
            <input type="text" placeholder="Etat" name="etat" required>
            <input type="text" placeholder="Numéro de Devis" name="num" required>

            <select name="user">
                <?php
                $requete = $conn->conbdd()->query("SELECT id_user, nom, prenom FROM user");
                $resultat = $requete->fetchAll();

                foreach ($resultat as $user) {
                    ?>
                    <option value="<?= $user['id_user'] ?>"><?= $user['nom'] . " " . $user['prenom'] ?></option>
                    <?php
                }
                ?>
            </select>

            <select name="classe">
                <?php
                $requete = $conn->conbdd()->query("SELECT id_classe, libelle FROM classe");
                $resultat = $requete->fetchAll();

                foreach ($resultat as $classe) {
                    ?>
                    <option value="<?= $classe['id_classe'] ?>"><?= $classe['libelle']?></option>
                    <?php
                }
                ?>
            </select>

            <select name="fournisseur">
                <?php
                $requete = $conn->conbdd()->query("SELECT id_fournisseur, entreprise FROM fournisseur");
                $resultat = $requete->fetchAll();

                foreach ($resultat as $fournisseur) {
                    ?>
                    <option value="<?= $fournisseur['id_fournisseur'] ?>"><?= $fournisseur['entreprise']?></option>
                    <?php
                }
                ?>
            </select>

            <select name="matiere">
                <?php
                $requete = $conn->conbdd()->query("SELECT id_matiere, ref_materiau, ref_forme FROM matiere");
                $resultat = $requete->fetchAll();

                foreach ($resultat as $matiere) {
                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
                    $requete->execute(['id' => $matiere['ref_materiau']]);
                    $result = $requete->fetch();
                    $materiau = $result['libelle'];

                    $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
                    $requete->execute(['id' => $matiere['ref_forme']]);
                    $result = $requete->fetch();
                    $forme = $result['libelle'];
                    ?>
                    <option value="<?= $matiere['id_matiere']?>"><?= $forme . " " . $materiau?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="reset">Réinitialiser</button>
            <button name="commande" type="submit">Commander</button>
        </div>
    </form>
</div>

<script>
    var modal = document.getElementById("modal-commande");
    var span = document.getElementsByClassName("close")[0];

    function afficher() {
        modal.style.display = "block";

        // Centrer la pop-up au milieu de l'écran
        modal.style.transform = "translate(-50%, -50%)";
        modal.style.top = "50%";
        modal.style.left = "50%";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    $(document).ready( function () {
        $('#historique').DataTable();
    } );
</script>
</body>
</html>

