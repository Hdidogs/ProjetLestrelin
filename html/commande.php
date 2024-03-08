<?php
include "../php/SQLConnexion.php";
$conn = new SQLConnexion();
$req = $conn->conbdd()->query("SELECT * FROM fournisseur");
$fournisseur = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM user WHERE ref_fonction = 1");
$professeur = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM classe");
$classe = $req->fetchAll();
$req = $conn->conbdd()->query("SELECT * FROM matierecommande");
$nposte = $req->fetchAll();
?>
<html>
<body>
<form action="../php/commande/commande.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleFormControlSelect1">Fournisseur :</label>
            <select name="fournisseur">
                <option><?php foreach ($fournisseur as $liste): ?>
                <option value="<?php echo $liste['id_fournisseur']; ?>"><?php echo $liste['mail']; ?></option>
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
            <select class="js-example-basic-multiple" name="states[]" multiple="multiple" name="numeroP">
                <option><?php foreach ($nposte as $liste): ?>
                <option value="<?php echo $liste['id_matierecommande']; ?>"><?php echo $liste['prix']; ?><?php echo $liste['quantite']; ?></option>
                <?php endforeach;?>
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