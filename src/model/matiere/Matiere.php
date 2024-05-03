<?php
namespace matiere;
ob_start();
include "../../model/Mail.php";
use Mail;
use SQLConnexion;
include "../../bdd/SQLConnexion.php";
include "../../model/Exel.php";
use Exel;


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
    private $libelle;

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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
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

    public function supprimer()
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

        header("Location: ../../../vue/main/gestionMatiere.php");
    }

    public function debit()
    {
        $conn = new SQLConnexion();

        $req = $conn->conbdd()->prepare("INSERT INTO debit (date, quantite, ref_piece, ref_user, ref_classe, ref_matiere) VALUES (:date, :quantite, :piece, :user, :classe, :matiere)");
        $req->execute(['date' => $this->getDate(), 'quantite' => $this->getQuantite(), 'piece' => $this->getPiece(), 'user' => $this->getUser(), 'classe' => $this->getClasse(), 'matiere' => $this->getMatiere()]);

        $req = $conn->conbdd()->prepare("UPDATE matiere SET longueur = longueur - :quantite");
        $req->execute(['quantite' => $this->getQuantite()]);

        header("Location: ../../../vue/main/debitMatiere.php");
    }

    public function addnewMatiere(){
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("INSERT INTO matiere (id_matiere, id_forme, longeur, largeur, epaisseur, diametre, hauteur)
        VALUES ('materiau','forme','longueur','largeur','epaisseur','diametre','hauteur')");
        $req->execute(['materiau' => $this->getRefMateriau(), 'forme' => $this->getRefForme(), 'longueur' => $this->getLongueur(), 'largeur' => $this->getLargeur(), 'epaisseur' => $this->getEpaisseur(), 'diametre' => $this->getDiametre(), 'hauteur' => $this->getHauteur()]);
        header("Location: ../../../vue/main/gestionMatiere.php");
    }
    
    public function addForme()
    {

        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("INSERT INTO forme (libelle, longeur, largeur, epaisseur, diametre, hauteur) VALUES (:libelle, :longeur, :largeur, :epaisseur, :diametre, :hauteur)");
            $req->execute(['libelle' => $this->getLibelle(), 'longeur' => $this->getLongueur(), 'largeur' => $this->getLargeur(), 'epaisseur' => $this->getEpaisseur(), 'diametre' => $this->getDiametre(), 'hauteur' => $this->getHauteur()]);
        header("Location: ../../../vue/main/gestionMatiere.php");
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

        $data = array(
            array('Numéro de devis', 'Nom', 'Prénom', 'Classe', 'Matière', 'Quantité', 'Forme', 'Materiau'),
            array($this->getNum(), $user['nom'], $user['prenom'], $classe['libelle'], $materiau, $this->getQuantite(), $forme, $materiau)
        );

        Mail::SENDMAIL ($mail, "Devis " . $this->getNum(), "Nouvelle Commande de " . $user['nom'] . " " . $user['prenom'] . " pour la classe " . $classe['libelle'] . ". Nous avons besoin de " . $forme . " " . $materiau . " de " . $this->getQuantite() . " mètres de long.", $data);
        Exel::createExel($this->getDate(), $this->getNum(), $this->getFournisseur(), $user['nom'], $user['prenom'], $mail, $classe['libelle']);
        header("Location: ../../../vue/main/commandeMatiere.php");
        ob_end_flush();
    }

    public function ajouter {

    }
}