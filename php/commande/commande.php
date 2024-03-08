<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
var_dump($_POST["fournisseur"]);
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
    if(isset($_POST['fournisseur'])) {
        // Vérifie si les adresses e-mail sont au bon format
        if(filter_var($_POST['fournisseur'], FILTER_VALIDATE_EMAIL)) {
            $mail->addAddress($_POST['fournisseur']);
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
    $mail->addAddress($_POST['fournisseur']);     //Add a recipient
    $mail->addAddress('mrlestrelin0@gmail.com');  //Name is optional
    $mail->addAddress('mrlestrelin@gmail.com');
    $mail->addReplyTo('mrlestrelin0@gmail.com', 'Lestrelin');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['ndevis'];
    $mail->Body = $_POST['comment'];
    $mail->AltBody = $_POST['comment'];

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
