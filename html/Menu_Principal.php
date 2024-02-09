<HTML>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="../css/les-styles.css">
<link rel="stylesheet" href="../css/les-styles.css">
<body style="background-color:white;">

Professeur : <select name="professeur" id="professeur-select">
    <option value="">Choix Professeur</option>
    <option value="M.Lestrelin">M.Lestrelin</option>
    <option value="M.Lemoine">M.Lemoine</option>
    <option value="M.Mattei">M.Mattei</option>
</select>
<br>
Unite pedagogique : <select name="unite-Pedagogique" id="unite-select">
    <option value="">Choix de classe</option>
    <option></option>
</select>
<br>
Date : <input type="date" id="dateCommande" name="date">
<br>
Fournisseur : <select name="fournisseur" id="fournisseur-select">
    <option value="">Choix du fournisseur</option>
    <option></option>
</select>
<br>
<h2>Menue Principal</h2>
<button class="btn-orange" name="btncommande">Commander</button>
<button class="btn-rouge" name="btnajout">Ajouter</button>
<button class="btn-vert" name="btnerreur">Erreur</button>
<form action="gestionDeProjet.php">
<button type="submit" class="btn-bleu" name="btnprojet">Projet</button>
</form>
</body>
</HTML>
