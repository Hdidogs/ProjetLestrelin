<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../../vendor/autoload.php';

class Mail
{
    public static function SENDMAIL($mailSend, $obj, $msg)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mrlestrelin0@gmail.com';                     //SMTP username
            $mail->Password = 'gzqzsuayjipgnecr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients

            $mail->setFrom("mrlestrelin0@gmail.com", 'Lestrelin');
            $mail->addAddress($mailSend);
            $mail->addAddress('mrlestrelin0@gmail.com');  //Name is optional
            $mail->addReplyTo('mrlestrelin0@gmail.com', 'Lestrelin');

            //Content
            $mail->isHTML(true);
            $mail->Subject = $obj;
            $mail->Body = $msg;
            $mail->AltBody = $msg;

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
            $mail->addAttachment('../../assets/pdf/devis.pdf');

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}