<?php
include 'SQLConnexion.php';

class User{
    private String $nom;
    private String $prenom;
    private String $mail;
    private String $mdp;

    function __construct(String $nom, String $prenom, String $mail, String $mdp) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }

    public function connexion(User $u): bool {
        $co = new SQLConnexion();
        $res = $co->conbdd()->prepare("SELECT * FROM user WHERE mail = :mail");
        $res->execute(['mail'=>$u->getMail()]);
        $user = $res -> fetch();

        $id = $user['id_user'];
        $usermdp = $user['mdp'];
        $usernom = $user['nom'];
        $userprenom = $user['prenom'];
        $usermail = $user['mail'];

        if (password_verify($u->getMdp(), $usermdp)) {
            session_start();

            $_SESSION['id_user'] = $id;
            $_SESSION['nom'] = $usernom;
            $_SESSION['prenom'] = $userprenom;
            $_SESSION['mail'] = $usermail;
            $_SESSION['mdp'] = $usermdp;

            header("Location: ../html/index.php");
            return true;
        } else {
            header("Location: ../html/connexion.html");
            return false;
        }
    }

    public function inscription(User $u): bool {
        $co = new SQLConnexion();
        $add_user = $co->conbdd()->prepare("INSERT INTO user (nom, prenom, mail, mdp) VALUES (:nom, :prenom, :mail, :mdp)");
        $add_user->execute(['nom'=>$u->getNom(), 'prenom'=>$u->getPrenom(), 'mail'=>$u->getMail(), 'mdp' =>$u->getMdp()]);

        $id_user = $co->conbdd()->lastInsertId();

        if ($id_user != null) {
            session_start();

            $_SESSION['id_user'] = $id_user;
            $_SESSION['nom'] = $u->getNom();
            $_SESSION['prenom'] = $u->getPrenom();
            $_SESSION['mail'] = $u->getMail();
            $_SESSION['mdp'] = $u->getMdp();

            header("Location: ../html/index.php");
            return true;
        } else {
            header("Location: ../html/inscription.php");
            return false;
        }
    }

    public function checkIfMailExist(User $u): bool {
        $co = new SQLConnexion();

        $check_mail = $co->conbdd()->prepare("SELECT mail FROM user WHERE mail = :mail");
        $check_mail->execute(['mail'=>$u->getMail()]);

        $mail = $check_mail->fetch();

        if ($mail['mail'] != null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfUserEntreprise(User $u): array {
        $co = new SQLConnexion();

        $check_entreprise = $co->conbdd()->prepare("SELECT ref_entreprise FROM userentreprise WHERE ref_user = :user");
        $check_entreprise->execute(['user'=>$_SESSION['id_user']]);

        $entreprise = $check_entreprise->fetchAll();

        return $entreprise;
    }
}