<?php
include 'SQLConnexion.php';

$mdp = $_POST['mdp'];
$mail = $_POST['mail'];

User::CONNEXION($mail, $mdp);
?>
