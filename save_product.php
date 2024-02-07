<?php
// Connexion à la base de données
$servername = 'localhost'; // Nom d'hôte
$username = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe
$dbname = 'sak_estrelin'; // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
 die("La connexion a échoué: " . $conn->connect_error);
}

// Vérification que les données du produit sont bien envoyées
if(isset($_POST['product_name']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['cm'])) {
 $product_name = $_POST['product_name'];
 $quantity = $_POST['quantity'];
 $price = $_POST['price'];
 $centimeters = $_POST['cm'];

 // Requête SQL pour insérer les données du produit
 $sql = "INSERT INTO Stock (product_name, quantity, price, centimeters) VALUES ('$product_name', $quantity, $price, $centimeters)";

 // Exécution de la requête SQL
 if ($conn->query($sql) === TRUE) {
  echo "Produit enregistré avec succès";
 } else {
  echo "Erreur: " . $sql . "<br>" . $conn->error;
 }
} else {
 echo "Paramètres manquants";
}

var_dump($_POST);


// Fermeture de la connexion
$conn->close();
?>