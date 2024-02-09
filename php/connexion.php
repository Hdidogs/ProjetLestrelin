<?php
include 'User.php';

$mdp = $_POST['mdp'];
$mail = $_POST['mail'];

$user = new User(" ", " ", $mail, $mdp);

$user->connexion($user);
?>
