<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bon de débit Matière</title>


</head>
<body>
    <div class="container">
        <h1>Bon de débit Matière</h1>

        <select class="scroll" name="professeurProjet" id="professeurProjet-select" required>
            <option value="">Choix du professeur</option>
        </select>

        <div class="checkbox-container">
            <label>Filiere :</label>
            <input type="checkbox" name="tu"> TU
            <input type="checkbox" name="cprp"> CPRP
            <input type="checkbox" name="cged"> CQPM
            <input type="checkbox" name="spe"> SPE
            <input type="checkbox" name="sn"> SN
            <input type="checkbox" name="slam"> SLAM
            <input type="checkbox" name="sisr"> SISR
        </div>

        <input class="image" type="image" alt="visuelPiece" name="imagePiece" id="imagePiece" src="../assets/images/50-Lycee-Robert-Schuman.jpg" width="200" height="250" required>

        <select class="scroll" name="classeProjet" id="classeProjet-select" required>
            <option value="">Choix de la classe</option>
        </select>

        <select class="scroll" name="choixMateriaux" id="choixMateriaux-select" required>
            <option value="">Choix du matériau</option>
        </select>

        <select class="scroll" name="systemeProjet" id="systemeProjet-select" required>
            <option value="">Choix du projet</option>
        </select>

        <select class="scroll" name="pieceProjet" id="pieceProjet-select" required>
            <option value="">Choix de la pièce</option>
        </select>

        <select class="scroll" name="forme" id="forme-select" required>
            <option value="">Choix de la forme</option>
        </select>

        <select class="scroll" name="dimension" id="dimension-select" required>
            <option value="">Choix de la dimension</option>
        </select>

        <input type="text" name="quantite" placeholder="Quantité">
        <input type="text" name="longeur" placeholder="Longueur">
        <input type="text" name="stockinitial" placeholder="Stock initial">
        <input type="text" name="stockfinal" placeholder="Stock final">

        <button type="submit">Envoyer</button>
    </div>
</body>
</html>
