<?php
include '../SQLConnexion.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mdp = $_POST['mdp'];
$remdp = $_POST['remdp'];
$mail = $_POST['mail'];

if ($remdp == $mdp) {
    $newmdp = password_hash($mdp,PASSWORD_DEFAULT);

    $prenom = strtolower($prenom);
    $user = new User(["nom"=>strtoupper($nom), "prenom"=>ucfirst($prenom), "mail"=>$mail, "mdp"=>$newmdp, "fonction"=>"Elève"]);

    var_dump($user->checkIfMailExist());
    if ($user->checkIfMailExist()) {
        header("Location: ../../html/inscription.html");
    } else {
        $user->inscription();
    }
} else {
    header("Location: ../../html/inscription.html");
}
?>