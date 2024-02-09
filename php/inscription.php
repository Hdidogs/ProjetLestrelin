<?php
include 'User.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mdp = $_POST['mdp'];
$remdp = $_POST['remdp'];
$mail = $_POST['mail'];

if ($remdp == $mdp) {
    $newmdp = password_hash($mdp,PASSWORD_DEFAULT);

    $user = new User($nom, $prenom, $mail, $newmdp);

    if ($user->checkIfMailExist($user)) {
        header("Location: ../html/inscription.html");
    } else {
        $user->inscription($user);
    }
} else {
    header("Location: ../html/inscription.html");
}
?>