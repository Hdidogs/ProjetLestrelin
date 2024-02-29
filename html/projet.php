<html>
<body>
<form action="../php/projet/projet.php" method="post" enctype="multipart/form-data">
<label>Choix du projet :</label>
    <div>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept=".jpeg, .jpg, .png, .jifi">
        <br>
        <input type="text" name="nouveauNom">
    </div>
    <div>
        <label for="Ajouter">Ajouter</label>
        <input type="submit" value="Ajouter">
    </div>
</form>
</body>
</html>
