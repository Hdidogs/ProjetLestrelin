<?php
include "../SQLConnexion.php";

class Matiere
{
    private $id;
    private $date;
    private $quantite;
    private $piece;
    private $user;
    private $classe;
    private $matiere;
    private $fournisseur;
    private $num;
    private $etat;
    private $ref_forme;
    private $ref_materiau;
    private $longueur;
    private $hauteur;
    private $epaisseur;
    private $largeur;
    private $diametre;

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


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getPiece()
    {
        return $this->piece;
    }

    /**
     * @param mixed $piece
     */
    public function setPiece($piece): void
    {
        $this->piece = $piece;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse($classe): void
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere): void
    {
        $this->matiere = $matiere;
    }

    /**
     * @return mixed
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * @param mixed $fournisseur
     */
    public function setFournisseur($fournisseur): void
    {
        $this->fournisseur = $fournisseur;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    public function getLargeur()
    {
        return $this->largeur;
    }

    public function setLargeur($largeur): void
    {
        $this->largeur = $largeur;
    }

    public function getHauteur()
    {
        return $this->hauteur;
    }

    public function setHauteur($hauteur): void
    {
        $this->hauteur = $hauteur;
    }

    public function getLongueur()
    {
        return $this->longueur;
    }

    public function setLongueur($longueur): void
    {
        $this->longueur = $longueur;
    }

    public function getEpaisseur()
    {
        return $this->epaisseur;
    }

    public function setEpaisseur($epaisseur): void
    {
        $this->epaisseur = $epaisseur;
    }

    public function getDiametre()
    {
        return $this->diametre;
    }

    public function setDiametre($diametre): void
    {
        $this->diametre = $diametre;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): void
    {
        $this->nom = $nom;
    }



    public function supprimer()}
    {
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("DELETE FROM debit WHERE ref_matiere = :id");
        $req->execute(["id" => $this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierecommande WHERE ref_matiere = :id");
        $req->execute(["id" => $this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierefournisseur WHERE ref_matiere = :id");
        $req->execute(["id" => $this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierepiece WHERE ref_matiere = :id");
        $req->execute(["id" => $this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matiere WHERE id_matiere = :id");
        $req->execute(["id" => $this->getId()]);

        header("Location: ../../html/gestionMatiere.php");
    }

    public function debit()
    {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("INSERT INTO debit (date, quantite, ref_piece, ref_user, ref_classe, ref_matiere) VALUES (:date, :quantite, :piece, :user, :classe, :matiere)");
        $req->execute(['date' => $this->getDate(), 'quantite' => $this->getQuantite(), 'piece' => $this->getPiece(), 'user' => $this->getUser(), 'classe' => $this->getClasse(), 'matiere' => $this->getMatiere()]);

        $req = $conn->conbdd()->prepare("UPDATE matiere SET longueur = longueur - :quantite");
        $req->execute(['quantite' => $this->getQuantite()]);

        header("Location: ../../html/debitMatiere.php");
    }

    public function addForme()
    {

        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("INSERT INTO forme (libelle, longeur, largeur, epaisseur, diametre, hauteur) VALUES (:libelle, :longeur, :largeur, :epaisseur, :diametre, :hauteur)");
        $req->execute(['libelle' => $this->getNom(), 'longeur' => $this->getLongueur(), 'largeur' => $this->getLargeur(), 'epaisseur' => $this->getEpaisseur(), 'diametre' => $this->getDiametre(), 'hauteur' => $this->getHauteur()]);
        header("Location: ../../html/gestionMatiere.php");
    }   


    public function modifier()
    {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("UPDATE matiere SET nom = :nom, unite = :unite, stock = :stock, seuil = :seuil, ref_classe = :classe WHERE id_matiere = :id");
        $req->execute(['nom' => $this->getNom(), 'unite' => $this->getUnite(), 'stock' => $this->getStock(), 'seuil' => $this->getSeuil(), 'classe' => $this->getClasse(), 'id' => $this->getId()]);

        header("Location: ../../html/gestionMatiere.php");
    }

    public function commande()
    {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("INSERT INTO commande (date, quantite, etat, num_devis, ref_classe, ref_user, ref_matiere, ref_fournisseur) VALUES (:date, :quantite, :etat, :num, :classe, :user, :matiere, :fournisseur)");
        $req->execute(['date' => $this->getDate(), 'quantite' => $this->getQuantite(), 'etat' => $this->getEtat(), 'num' => $this->getNum(), 'classe' => $this->getClasse(), 'user' => $this->getUser(), 'matiere' => $this->getMatiere(), 'fournisseur' => $this->getFournisseur()]);

        $requete = $conn->conbdd()->prepare("SELECT mail FROM fournisseur WHERE id_fournisseur = :id");
        $requete->execute(['id' => $this->getFournisseur()]);
        $result = $requete->fetch();
        $mail = $result['mail'];

        $req = $conn->conbdd()->prepare("SELECT ref_materiau, ref_forme FROM matiere WHERE id_matiere = :id");
        $req->execute(['id' => $this->getMatiere()]);
        $res = $req->fetch();

        $requete = $conn->conbdd()->prepare("SELECT libelle FROM materiau WHERE id_materiau = :id");
        $requete->execute(['id' => $res['ref_materiau']]);
        $result = $requete->fetch();
        $materiau = $result['libelle'];

        $requete = $conn->conbdd()->prepare("SELECT libelle FROM forme WHERE id_forme = :id");
        $requete->execute(['id' => $res['ref_forme']]);
        $result = $requete->fetch();
        $forme = $result['libelle'];

        $requete = $conn->conbdd()->prepare("SELECT nom, prenom FROM user WHERE id_user = :id");
        $requete->execute(['id' => $this->getUser()]);
        $user = $requete->fetch();

        $requete = $conn->conbdd()->prepare("SELECT libelle FROM classe WHERE id_classe = :id");
        $requete->execute(['id' => $this->getClasse()]);
        $classe = $requete->fetch();

        header("Location: ../commande/commande.php?fournisseur=" . $mail . "&ndevis=" . $this->getNum() . "&nom=" . $user['nom'] . "&prenom=" . $user['prenom'] . "&classe=" . $classe['libelle'] . "&forme=" . $forme . "&quantite=" . $this->getQuantite() . "&materiau=" . $materiau);
    }
}