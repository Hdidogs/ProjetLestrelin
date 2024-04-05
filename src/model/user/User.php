<?php

namespace user;
use SQLConnexion;
include "../../bdd/SQLConnexion.php";

class User
{
    private string $nom;
    private string $prenom;
    private string $mail;
    private string $mdp;
    private string $fonction;

    function __construct(array $info)
    {
        $this->hydrate($info);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
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

    public function getFonction(): string
    {
        return $this->fonction;
    }

    public function getFonctionId(): string
    {
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("SELECT id_fonction FROM `fonction` WHERE libelle = :fonction");
        $req->execute(["fonction" => $this->fonction]);
        $res = $req->fetch();

        return $res['id_fonction'];
    }

    public function setFonction(string $fonction): void
    {
        $this->fonction = $fonction;
    }

    public static function CONNEXION($mail, $mdp)
    {
        $conn = new SQLConnexion();
        $res = $conn->conbdd()->prepare("SELECT * FROM user WHERE mail = :mail");
        $res->execute(['mail' => $mail]);
        $user = $res->fetch();

        $id = $user['id_user'];
        $usermdp = $user['mdp'];
        $usernom = $user['nom'];
        $userprenom = $user['prenom'];
        $usermail = $user['mail'];
        $fonction = $user['ref_fonction'];

        if (password_verify($mdp, $usermdp)) {
            session_start();

            $_SESSION['id_user'] = $id;
            $_SESSION['nom'] = $usernom;
            $_SESSION['prenom'] = $userprenom;
            $_SESSION['mail'] = $usermail;
            $_SESSION['fonction'] = $fonction;

            header("Location: ../../../vue/main/index.php");
            return true;
        } else {
            header("Location: ../../../vue/main/connexion.html");
            return false;
        }
    }

    public function inscription()
    {
        $co = new SQLConnexion();
        $add_user = $co->conbdd()->prepare("INSERT INTO user (nom, prenom, mail, mdp, ref_fonction) VALUES (:nom, :prenom, :mail, :mdp, :fonction)");
        $add_user->execute(['nom' => $this->getNom(), 'prenom' => $this->getPrenom(), 'mail' => $this->getMail(), 'mdp' => $this->getMdp(), 'fonction' => $this->getFonctionId()]);

        $id_user = $co->conbdd()->lastInsertId();

        var_dump($id_user);

        if ($id_user) {
            session_start();

            $_SESSION['id_user'] = $id_user;
            $_SESSION['nom'] = $this->getNom();
            $_SESSION['prenom'] = $this->getPrenom();
            $_SESSION['mail'] = $this->getMail();
            $_SESSION['fonction'] = $this->getFonction();
            header("Location: ../../../vue/main/index.php");
            return true;
        } else {
            header("Location: ../../../vue/main/connexion.html");
            return false;
        }
    }

    public function checkIfMailExist(): bool
    {
        $co = new SQLConnexion();

        $check_mail = $co->conbdd()->prepare("SELECT mail FROM user WHERE mail = :mail");
        $check_mail->execute(['mail' => $this->getMail()]);

        $mail = $check_mail->fetchAll();

        if ($mail != null) {
            return true;
        } else {
            return false;
        }
    }
}