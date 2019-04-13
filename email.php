<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$to = "";
if (isset($_POST['mail'])) {
    $to = $_POST['mail'];
}
$from = "efreirevendiquons@gmail.com";
$title = "Inscription";

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'efreirevendiquons@gmail.com';            // SMTP username
    $mail->Password = '5UJndX7v4';                         // SMTP password
    //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    // Avoid SSL errors
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom($from, 'Revendiquons');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient

    // avec database tu récupères ton adresse mail
    // SELECT mail FROM user WHERE user_id = 1;
    $emailTo_FromDb = $to;                         //l'adresse mail du destinataire
    $mail->addAddress($emailTo_FromDb);                                  // Name is optional

    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $from.' : '.$title;
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    echo 'before Send';
    $mail->send();
    echo 'message send';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>
