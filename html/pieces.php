<html>
    <body>
    <form action="../php/projet/pieces/pieces.php" method="post" enctype="multipart/form-data">
    <select class="scroll"  name="choixMatiere" id="choixMatiere-select" required>
        <option value="">Choix du metériaux</option>
        <option value="bois">bois</option>
    </select>
    <br>
    <select class="scroll"  name="projet" id="projet-select" required>
        <option value="">Choix de la pièce</option>
        <option value="roue">roue</option>
    </select>
    <br>
    <input type="text" name="nouveauNom" required>
    <br>
    <input type="file" name="image" required>
        <br>
        <input type="submit" value="Ajouter">
    </body>
</html>