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
$mail->charSet = 'utf-8';
$mail->Encoding = 'base64';

$sujet = "Demande de groupe";
$service = $_POST['service'];
$entreprise = $_POST['entreprise'];
$nom = $_POST['nom'];
$courriel = $_POST['courriel'];
$telephone = $_POST['telephone'];
$poste = $_POST['poste'];
$vous = $_POST['vous'];
$message = $_POST['message'];

//Message dans le email
$txt = utf8_encode("Une demande de groupe a été effectué pour le service suivant : ".$service."<br>"
."Entreprise : ".$entreprise."<br>"
."Nom du responsable : ".$nom."<br>"
."Téléphone : ".$telephone."<br>". " Poste : ".$poste."<br><br>"
."Parlez-nous de vous : ".$vous."<br><br>"
."Message/Demande : ".$message."<br>");

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ekahinfo@gmail.com';                   // SMTP username
    $mail->Password   = 'Facilitateur2019';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($courriel, $nom);
    $mail->addAddress('popa2000@hotmail.ca', 'Joe');     // Le recipient
                                                        // Nom optionnel
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sujet;
    $body = $txt;
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $status = "success";
    $response = 'Message has been sent';
    exit(json_encode(array("status" => $status, "response" => $response)));
} catch (Exception $e) {
    $status = "failed";
    $response = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>
