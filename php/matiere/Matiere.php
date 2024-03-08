<?php
include "../SQLConnexion.php";

class Matiere {
    private $id;

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

    public function supprimer() {
        $conn = new SQLConnexion();
        $req = $conn->conbdd()->prepare("DELETE FROM matiere WHERE ref_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        $req = $conn->conbdd()->prepare("DELETE FROM matiere WHERE id_matiere = :id");
        $req->execute(["id"=>$this->getId()]);

        header("Location: ../../html/gestionMatiere.php");
    }
}