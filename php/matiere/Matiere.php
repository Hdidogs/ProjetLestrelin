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
}