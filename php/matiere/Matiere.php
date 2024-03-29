<?php
include "../SQLConnexion.php";

class Matiere {
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

    function __construct(array $info) {
        $this->hydrate($info);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);

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

    /**
     * @return mixed
     */
    public function getRefForme()
    {
        return $this->ref_forme;
    }

    /**
     * @param mixed $ref_forme
     */
    public function setRefForme($ref_forme): void
    {
        $this->ref_forme = $ref_forme;
    }

    /**
     * @return mixed
     */
    public function getRefMateriau()
    {
        return $this->ref_materiau;
    }

    /**
     * @param mixed $ref_materiau
     */
    public function setRefMateriau($ref_materiau): void
    {
        $this->ref_materiau = $ref_materiau;
    }

    /**
     * @return mixed
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * @param mixed $longueur
     */
    public function setLongueur($longueur): void
    {
        $this->longueur = $longueur;
    }

    /**
     * @return mixed
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * @param mixed $hauteur
     */
    public function setHauteur($hauteur): void
    {
        $this->hauteur = $hauteur;
    }

    /**
     * @return mixed
     */
    public function getEpaisseur()
    {
        return $this->epaisseur;
    }

    /**
     * @param mixed $epaisseur
     */
    public function setEpaisseur($epaisseur): void
    {
        $this->epaisseur = $epaisseur;
    }

    /**
     * @return mixed
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * @param mixed $largeur
     */
    public function setLargeur($largeur): void
    {
        $this->largeur = $largeur;
    }

    /**
     * @return mixed
     */
    public function getDiametre()
    {
        return $this->diametre;
    }

    /**
     * @param mixed $diametre
     */
    public function setDiametre($diametre): void
    {
        $this->diametre = $diametre;
    }

    public function ajouter()
    {
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("INSERT INTO matiere (`ref_materiau`, `ref_forme`, `longueur`, `hauteur`, `epaisseur`, `largeur`, `diametre`) VALUES (:materiau, : forme, :longueur, :hauteur, :epaisseur, :largeur, :diametre)");
        $req->execute(['materiau'=>$this->getRefMateriau(), 'forme'=>$this->getRefForme(), 'longueur'=>$this->getLongueur(), 'hauteur'=>$this->getHauteur(),'epaisseur'=>$this->getEpaisseur() , 'largeur'=>$this->getLargeur(), 'diametre'=>$this->getDiametre()]);

        header("Location: ../../html/gestionMatiere.php");
    }

    public function supprimer() {
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("DELETE FROM debit WHERE ref_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierecommande WHERE ref_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierefournisseur WHERE ref_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matierepiece WHERE ref_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matiere WHERE id_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        header("Location: ../../html/gestionMatiere.php");
    }

    public function debit() {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("INSERT INTO debit (date, quantite, ref_piece, ref_user, ref_classe, ref_matiere) VALUES (:date, :quantite, :piece, :user, :classe, :matiere)");
        $req->execute(['date'=>$this->getDate(), 'quantite'=>$this->getQuantite(), 'piece'=>$this->getPiece(), 'user'=>$this->getUser(), 'classe'=>$this->getClasse(), 'matiere'=>$this->getMatiere()]);

        $req = $conn->conbdd()->prepare("UPDATE matiere SET longueur = longueur - :quantite");
        $req->execute(['quantite'=>$this->getQuantite()]);

        header("Location: ../../html/debitMatiere.php");
    }

    public function commande() {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("INSERT INTO commande (date, quantite, etat, num_devis, ref_classe, ref_user, ref_matiere, ref_fournisseur) VALUES (:date, :quantite, :etat, :num, :classe, :user, :matiere, :fournisseur)");
        $req->execute(['date'=>$this->getDate(), 'quantite'=>$this->getQuantite(), 'etat'=>$this->getEtat(), 'num'=>$this->getNum(), 'classe'=>$this->getClasse(), 'user'=>$this->getUser(), 'matiere'=>$this->getMatiere(), 'fournisseur'=>$this->getFournisseur()]);

        $requete = $conn->conbdd()->prepare("SELECT mail FROM fournisseur WHERE id_fournisseur = :id");
        $requete->execute(['id' =>$this->getFournisseur()]);
        $result = $requete->fetch();
        $mail = $result['mail'];

        $req= $conn->conbdd()->prepare("SELECT ref_materiau, ref_forme FROM matiere WHERE id_matiere = :id");
        $req->execute(['id'=>$this->getMatiere()]);
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
        $requete->execute(['id'=>$this->getUser()]);
        $user = $requete->fetch();

        $requete = $conn->conbdd()->prepare("SELECT libelle FROM classe WHERE id_classe = :id");
        $requete->execute(['id'=>$this->getClasse()]);
        $classe = $requete->fetch();

        header("Location: ../commande/commande.php?fournisseur=".$mail."&ndevis=".$this->getNum()."&nom=".$user['nom']."&prenom=".$user['prenom']."&classe=".$classe['libelle']."&forme=".$forme."&quantite=".$this->getQuantite()."&materiau=".$materiau);
    }
}