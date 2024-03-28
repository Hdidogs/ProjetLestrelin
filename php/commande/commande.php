<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);
$pdf = new Dompdf();

try {
    var_dump($_GET['fournisseur']);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'mrlestrelin0@gmail.com';                     //SMTP username
    $mail->Password = 'gzqzsuayjipgnecr';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Vérifie si les variables POST sont définies et non vides
    if (isset($_GET['fournisseur'])) {
        // Vérifie si les adresses e-mail sont au bon format
        if (filter_var($_GET['fournisseur'], FILTER_VALIDATE_EMAIL)) {
            $mail->addAddress($_GET['fournisseur']);
        } else {
            echo 'Adresse e-mail invalide.';
            // Arrête l'exécution du script si les adresses e-mail sont invalides
            exit();
        }
    } else {
        echo 'Les adresses e-mail ne sont pas définies.';
        // Arrête l'exécution du script si les adresses e-mail ne sont pas définies
        exit();
    }

    //Recipients
    $mail->setFrom("mrlestrelin0@gmail.com", 'Lestrelin');
    $mail->addAddress($_GET['fournisseur']);     //Add a recipient
    $mail->addAddress('mrlestrelin0@gmail.com');  //Name is optional
    $mail->addReplyTo('mrlestrelin0@gmail.com', 'Lestrelin');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_GET['ndevis'];
    $comment = "Nouvelle Commande de " . $_GET['nom'] . " " . $_GET['prenom'] . " pour la classe " . $_GET['classe'] . ". Nous avons besoin de " . $_GET['forme'] . " " . $_GET['materiau'] . " de " . $_GET['quantite'] . " mètres de long.";

    //Convert the HTML to a PDF
    $pdf->loadHtml($comment);
    $pdf->render();
    $output = $pdf->output();
    $target_dir = "../../../assets/pdf/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    // Construit le chemin complet du fichier image
    $imagePath = $target_dir . $_GET['ndevis'] . ".pdf";
    // Tente de déplacer le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($output, $imagePath)) {
        // Si le déplacement réussit, affiche un message de succès
        echo "Le fichier " . basename($output) . " a été téléchargé.";
    } else {
        // Sinon, affiche un message d'erreur
        echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
    }
    file_put_contents('devis.pdf', $output);

    //Attach the PDF file
    $mail->addAttachment('../assets/pdf/devis.pdf');

    $mail->Body = $comment;
    $mail->AltBody = $comment;

    $mail->send();
    echo 'Message has been sent';
    header("Location: ../../html/commandeMatiere.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: ../../html/commandeMatiere.php");
}


