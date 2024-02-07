<?php
$servername = 'localhost'; // Remplacez par votre nom d'hôte
$username = 'root'; // Remplacez par votre nom d'utilisateur
$password = ''; // Remplacez par votre mot de passe
$dbname = 'sak_estrelin'; // Remplacez par le nom de votre base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
?>