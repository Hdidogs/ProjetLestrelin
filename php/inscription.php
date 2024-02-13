<?php
include 'SQLConnexion.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mdp = $_POST['mdp'];
$remdp = $_POST['remdp'];
$mail = $_POST['mail'];

if ($remdp == $mdp) {
    $newmdp = password_hash($mdp,PASSWORD_DEFAULT);

    $user = new User(["nom"=>$nom, "prenom"=>$prenom, "mail"=>$mail, "mdp"=>$newmdp, "fonction"=>"Elève"]);

    var_dump($user->getFonctionId());
    if ($user->checkIfMailExist()) {
        header("Location: ../html/inscription.html");
    } else {
        $user->inscription();
    }
} else {
    header("Location: ../html/inscription.html");
}
?>