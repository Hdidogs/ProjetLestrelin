<html>
<link rel="stylesheet" href="../css/gestionDeProjet.css">
<h1 id="h1">Bon de débit Matiere</h1>
<body>
<select class="scroll"  name="professeurProjet" id="professeurProjet-select" required>
    <option value="">Choix du professeur</option>
</select>
<br>
<br>
Filiere : TU<input type="checkbox" name="tu">
CPRP<input type="checkbox" name="cprp" >
CQPM<input type="checkbox" name="cged" >
SPE<input type="checkbox" name="spe" >
<br>
<input class="image" type="image" alt="visuelPiece" name="imagePiece" id="imagePiece" src="../assets/images/50-Lycee-Robert-Schuman.jpg" width="200" height="250" required>
<br>
<select class="scroll"  name="classeProjet" id="classeProjet-select" required>
    <option value="">Choix de la classe</option>
</select>
<br>
<select class="scroll"  name="choixMateriaux" id="choixMateriaux-select" required>
    <option value="">Choix du metériaux</option>
</select>
<br>
<select class="scroll"  name="systemeProjet" id="systemeProjet-select required">
    <option value="">Choix du projet</option>
</select>
<br>
<select class="scroll"  name="pieceProjet" id="pieceProjet-select" required>
    <option value="">Choix de la pièce</option>
</select>
<br>
<select class="scroll"  name="forme" id="forme-select" required>
    <option value="">Choix de la forme</option>
</select>
<br>
<select class="scroll"  name="dimension" id="dimension-select" required>
    <option value="">Choix de la dimension</option>
</select>
<br>
<input type="text" name="quantite">
<br>
<input type="text" name="longeur">
<br>
<input type="text" name="stockinitial">
<br>
<input type="text" name="stockfinal">
</body>
</html>
