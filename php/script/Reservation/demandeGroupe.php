<?php
/**
 * Script pour envoyer un mail
 *
 * Nom :         demandeGroupe.php
 * Catégorie :   Script
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-14
 *
 * IMPORTANT: Le script fonctionne a merveille lorsqu'il est héberger sur le web
 * par contre avec XAMPP, il est impossible de le faire et je ne sais pas pourquoi la connection a SMTP échoue
 *
 * SOLUTION: DÉSACTIVER AVAST : a cause de sa protection contre les courriels
 */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Charger le composer
require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'karlboutin98@gmail.com';               // SMTP username
    $mail->Password   = '???';                       // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('elec19981109@hotmail.ca', 'George');
    $mail->addAddress('popa2000@hotmail.ca', 'Joe');     // Le recipient
                                                        // Nom optionnel
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test Email';
    $body = "<p>Hey this is a message.</p>";
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
