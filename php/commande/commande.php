<?php
use Aspose\Words\WordsApi;
use Aspose\Words\Model\Requests\{ConvertDocumentRequest};

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$wordsApi = new WordsApi('####-####-####-####-####', '##################');

$doc = "../../html/commande.php";
$request = new ConvertDocumentRequest(
    $doc, "pdf", NULL, NULL, NULL, NULL
);
$convert = $wordsApi->convertDocument($request);

$mail = new PHPMailer(true);

try {

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'mrlestrelin0@gmail.com';                     //SMTP username
    $mail->Password = 'Lestrelin0!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("mrlestrelin@gmail.com", 'Lestrelin');
    $mail->addAddress($_POST['fournisseur']);     //Add a recipient
    $mail->addAddress($_POST['mailDDFPT']);  //Name is optional
    $mail->addAddress('mrlestrelin@gmail.com');
    $mail->addReplyTo('mrlestrelin@gmail.com', 'Lestrelin');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

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
