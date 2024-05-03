<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/tecnickcom/tcpdf/tcpdf.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Mail
{
    public static function SENDMAIL($mailSend, $obj, $msg, $data)
    {
        $mail = new PHPMailer(true);
        $error_message = "";

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
            $pdfFilename = __DIR__ .'/../../assets/pdf/devis.pdf';
            self::creatPDF($pdfFilename,$data);
            //$pdf->loadHtml($comment);
            //$pdf->render();
            //$output = $pdf->output();
            //$target_dir = "../../../assets/pdf/";
//
            //if (!file_exists($target_dir)) {
            //    mkdir($target_dir, 0777, true);
            //}
            //// Construit le chemin complet du fichier image
            //$imagePath = $target_dir . $_GET['ndevis'] . ".pdf";
            //// Tente de déplacer le fichier téléchargé vers le répertoire de destination
            //if (move_uploaded_file($output, $imagePath)) {
            //    // Si le déplacement réussit, affiche un message de succès
            //    echo "Le fichier " . basename($output) . " a été téléchargé.";
            //} else {
            //    // Sinon, affiche un message d'erreur
            //    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            //}
            //file_put_contents('devis.pdf', $output);

            //Attach the PDF file
            $mail->addAttachment($pdfFilename);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            $error_message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $error_message;
    }

    public static function creatPDF($filename,$data)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Lestrelin');
        $pdf->SetTitle('Devis');
        $pdf->SetSubject('Devis');
        $pdf->SetKeywords('Devis');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $content = '<table border="1">';
        foreach ($data as $row) {
            $content .= '<tr>';
            foreach ($row as $col) {
                $content .= '<td>' . $col . '</td>';
            }
            $content .= '</tr>';
        }
        $content .= '</table>';
        $pdf->writeHTML($content, true, false, true, false, '');
        $pdf->Output($filename, 'F');
    }
}