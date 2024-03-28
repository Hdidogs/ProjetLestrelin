<?php
include "../php/SQLConnexion.php";
$conn = new SQLConnexion();
$req = $conn->conbdd()->query("SELECT * FROM fournisseur");
$fournisseur = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM user WHERE ref_fonction = 1");
$professeur = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM classe");
$classe = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM matierefournisseur");
$nposte = $req->fetchAll();
?>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
<form action="../php/commande/commande.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Fournisseur :</label>
            <select name="fournisseur">
                <option><?php foreach ($fournisseur as $liste): ?>
                <option value="<?php echo $liste['mail']; ?>"><?php echo $liste['mail']; ?></option>
                <?php endforeach;?>
            </select>
        </div>


        <div class="form-group">
            <label for="exampleFormControlSelect1">Professeur :</label>
            <select class="form-control" id="exampleFormControlSelect1" name="professeur">
                <option><?php foreach ($professeur as $liste): ?>
                <option value="<?php echo $liste['id_user']; ?>"><?php echo $liste['nom']; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Unite Pedagogique :</label>
            <select class="form-control" id="exampleFormControlSelect1" name="uniteP">
                <option><?php foreach ($classe as $liste): ?>
                <option value="<?php echo $liste['id_classe']; ?>"><?php echo $liste['libelle']; ?></option>
                <?php endforeach;?>
            </select>
        </div>


        <div class="form-group">
            <label for="exampleFormControlSelect1">N°Poste :</label>
            <select class="js-example-basic-multiple" name="states[]" multiple="multiple" name="numeroP" style="width: 150px">
                <?php foreach ($nposte as $liste) {
                    $req = $conn->conbdd()->prepare("SELECT ref_materiau, ref_forme FROM matiere WHERE id_matiere = :id");
                    $req->execute(["id"=>$liste['ref_matiere']]);

                    $res = $req->fetch();

                    $id_materiau = $res['ref_materiau'];
                    $id_forme = $res['ref_forme'];

                    $req = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
                    $req->execute(['id'=>$id_materiau]);

                    $resMateriau = $req->fetch();

                    $req = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
                    $req->execute(['id'=>$id_forme]);

                    $resForme = $req->fetch();
                    ?>
                <option value="<?php echo $liste['ref_matiere']; ?>"><?= $resForme['libelle'] . " en " . $resMateriau['libelle'] . " - " . $liste['prix']?></option>
                <?php }?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">N°Devis :</label>
            <input type="text" name="ndevis">
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1" >Condition de règlement :</label>
            <br>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" cols="30" placeholder="Condition de règlement :"></textarea>
        </div>


        <div class="modal-footer">
            <input type="hidden" name="submit">
            <input type="submit" name="submit" value="Envoyer">
        </div>
</form>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
</body>
</html>