<?php

include '../../SQLConnexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire ou assigne null si elles n'existent pas


    if (isset($_FILES['image'])) {
        // Vérifie si le téléchargement du fichier a réussi
        if ($_FILES['image']['error'] == 0) {
            // Définit le répertoire de destination pour les fichiers téléchargés
            $target_dir = "../../assets/images/";
            // Vérifie si le répertoire existe, sinon le crée
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $nouveauNom = $_POST['nouveauNom'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            // Construit le chemin complet du fichier image
            $imagePath = $target_dir . $nouveauNom . "." . $extension;
            // Tente de déplacer le fichier téléchargé vers le répertoire de destination
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Si le déplacement réussit, affiche un message de succès
                echo "Le fichier " . basename($_FILES["image"]["name"]) . " a été téléchargé.";
            } else {
                // Sinon, affiche un message d'erreur
                echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        } else {
            // Si une erreur s'est produite lors du téléchargement du fichier, affiche un message d'erreur avec le code d'erreur
            echo "Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error'];
        }
    }
    $conn = new SQLConnexion();
    $stmt = $conn->conbdd()->prepare("INSERT INTO projet (image,nom) VALUES (?,?)");
    $stmt->execute([$imagePath,$nouveauNom]);
    echo 'Image ajouté avec succès!';

    $matiere = $_POST["choixMatiere"];
    $projet = $_POST["projet"];
    $nouveauNom = $_POST['nouveauNom'];



    $stmt = $conn->conbdd()->prepare("SELECT m.id_matiere, m.nom, m.ref_materiau, m.ref_forme,m.longueur,m.hauteur,m.epaisseur,m.largeur,m.diametre,pr.id_projet	,pr.nom	,pr.image,pj.ref_piece,pj.ref_projet,p.img,p.nom,p.id_piece,mp.ref_matiere,mp.ref_piece FROM matiere as m 
    INNER JOIN matierepiece as mp on mp.ref_matiere = m.id_matiere
    INNER JOIN piece p on mp.ref_piece = p.id_piece  
    INNER JOIN pieceprojet pj on pj.ref_piece = p.id_piece
    INNER JOIN projet pr on pj.ref_projet = pr.id_projet
    WHERE p.nom = ? and m.nom = ? and pr.nom = ?");
    $stmt->execute(array($matiere,$projet,$nouveauNom));

}