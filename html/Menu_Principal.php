<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="mes-styles.css">
    <title>Menu Principal Moderne</title>
</head>
<body>

    <header class="date-header">
        <div class="container">
            <p class="date" id="currentDate"></p>
        </div>
    </header>

    <div class="formulaire-moderne">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <link rel="stylesheet" href="../css/menu_principal.css">
        <link rel="stylesheet" href="../css/mes-styles.css">
        <body style="background-color:white;">

        Professeur : <select class="scrolll" name="professeur" id="professeur-select" required>
            <option value="">Choix Professeur</option>
            <option value="M.Lestrelin">M.Lestrelin</option>
            <option value="M.Lemoine">M.Lemoine</option>
            <option value="M.Mattei">M.Mattei</option>
        </select>
        <br>
        Unite pedagogique : <select class="scrolll" name="unite-Pedagogique" id="unite-select" required>
            <option value="">Choix de classe</option>
            <option></option>
        </select>
        <br>
        Date : <input type="date" id="dateCommande" name="date" required>
        <br>
        Fournisseur : <select class="scrolll" name="fournisseur" id="fournisseur-select" required>
            <option value="">Choix du fournisseur</option>
            <option></option>
        </select>
        <br>
        <h2>Menue Principal</h2>
        <button class="btn-orange" name="btncommande">Commander</button>
        <button class="btn-rouge" name="btnajout">Ajouter</button>
        <button class="btn-vert" name="btnerreur">Erreur</button>
        <form action="gestionDeProjet.php">
            <button type="submit" class="btn-bleu" name="btnprojet">Débit</button>
        </form>
        </body>
    </div>

</body>
</html>
