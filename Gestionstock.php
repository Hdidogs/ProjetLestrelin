<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <style>
 body {
 background-color: #f2f2f2;
 font-family: Arial, sans-serif;
 }

 form {
 background-color: #fff;
 padding: 20px;
 border-radius: 10px;
 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
 }

 label {
 display: block;
 margin-bottom: 10px;
 font-weight: bold;
 } 

 select, input[type="text"], input[type="submit"] {
 width: 100%;
 padding: 10px;
 border: 1px solid #ccc;
 border-radius: 5px;
 margin-bottom: 10px;
 }

 input[type="submit"] {
 background-color: #4CAF50;
 color: #fff;
 cursor: pointer;
 }

 input[type="submit"]:hover {
 background-color: #45a049;
 }

 .container {
 max-width: 800px;
 margin: 0 auto;
 padding: 20px;
 }

 .title {
 font-size: 24px;
 font-weight: bold;
 margin-bottom: 20px;
 }

 .success-message {
 color: green;
 font-weight: bold;
 position: fixed;
 top: 0;
 left: 0;
 padding: 10px;
 }

 .error-message {
 color: red;
 font-weight: bold;
 }

 </style>
</head>
<body>
 <div class="container">
 <h1 class="title">Gestion du stock</h1>

 <form method="POST" action="save_product.php">
 <label for="produit">Produit :</label>
 <?php

 include 'database_connection.php';

 // Récupérer les produits depuis la base de données
 $sql = "SELECT * FROM produits";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
 echo '<select id="produit" name="produit">';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="' . $row["id_produits"] . '">' . $row["produit"] . '</option>';
 }
 echo '</select>';
 } else {
 echo "Aucun produit trouvé.";
 }
 $conn->close();
 ?>

 <div class="input-box">
 <label for="inputText">Taille (en cm) :</label>
 <input type="text" id="inputText" name="inputText">
 </div>

 <div class="input-box">
 <label for="inputPrice">Prix :</label>
 <input type="text" id="inputPrice" name="inputPrice">
 </div>

 <button type="submit">Ajouter le produit</button>
 </form>

 <div id="message"></div>
 </div>
</body>
</html>

<?php
include 'database_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Get the selected product, input text, and price
 $produit = $_POST["produit"];
 $inputText = $_POST["inputText"];
 $inputPrice = $_POST["inputPrice"];

 $conn->close();
}
?>
