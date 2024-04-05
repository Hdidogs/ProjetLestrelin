<?php
include "../../model/user/User.php";

use user\User;

if (array_key_exists("connexion", $_POST)) {
    $mdp = $_POST['mdp'];
    $mail = $_POST['mail'];

    $user = new User(["mail"=>$mail, "mdp"=>$mdp]);

    if ($user->checkIfMailExist()) {
        User::CONNEXION($mail, $mdp);
    } else {
        header("Location: ../../../vue/main/connexion.html");
    }
} else if (array_key_exists("inscription", $_POST)) {
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
            header("Location: ../../../vue/main/connexion.html");
        } else {
            $user->inscription();
        }
    } else {
        header("Location: ../../../vue/main/connexion.html");
    }
}
?>