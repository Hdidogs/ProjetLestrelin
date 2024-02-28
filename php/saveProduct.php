<?php
include "SQLConnexion.php";

$con = new SQLConnexion();
$conn = $con->conbdd();

// Vérification que les données du produit sont bien envoyées
if(isset($_POST['product_name']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['cm'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $centimeters = $_POST['cm'];

    // Requête SQL pour insérer les données du produit
    $sql = "INSERT INTO Stock (product_name, quantity, price, centimeters) VALUES ('$product_name', $quantity, $price, $centimeters)";
}
?>