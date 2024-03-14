<?php
include '../SQLConnexion.php';

$mdp = $_POST['mdp'];
$mail = $_POST['mail'];

$user = new User(["mail"=>$mail, "mdp"=>$mdp]);

if ($user->checkIfMailExist()) {
    User::CONNEXION($mail, $mdp);
} else {
    header("Location: ../../html/connexion.html");
}
?>
