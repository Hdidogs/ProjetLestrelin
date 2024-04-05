<?php
include '../../bdd/SQLConnexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire ou assigne null si elles n'existent pas


    if (isset($_FILES['image'])) {
        // Vérifie si le téléchargement du fichier a réussi
        if ($_FILES['image']['error'] == 0) {
            // Définit le répertoire de destination pour les fichiers téléchargés
            $target_dir = "../../../assets/images/";
            // Vérifie si le répertoire existe, sinon le crée
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $nouveauNom = $_POST['nouveauNom'];
            $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
            // Construit le chemin complet du fichier image
            $imagePath = $target_dir . $nouveauNom . ".". $extension;
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

    $stmt = $conn-> conbdd()->prepare("INSERT INTO projet (img, nom) VALUES (:img, :nom)");
    $stmt->execute(["img"=>$imagePath, "nom"=>$nouveauNom]);

    header("Location: ../../../vue/main/gestionProjet.php");
}
