<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/Exception.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/OAuth.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'quoted-printable';

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
$txt = "Une demande de groupe a été effectué pour le service suivant : ".$service."<br>"
."Entreprise : ".$entreprise."<br>"
."Nom du responsable : ".$nom."<br>"
."Courriel : ".$courriel."<br>"
."Téléphone : ".$telephone."<br>". " Poste : ".$poste."<br><br>"
."Parlez-nous de vous : ".$vous."<br><br>"
."Message/Demande : ".$message."<br>";

try {
    //Server settings
    //$mail->SMTPDebug = 2;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.ekah-app.co';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'demande.groupe@ekah-app.co';       // SMTP username
    $mail->Password = '*WUJZJfaa7Aa';                     // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('demande.groupe@ekah-app.co');
    $mail->addAddress('demande.groupe@ekah-app.co', 'Ekah');        // Add a recipient
                                                                    // Name is optional

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = html_entity_decode($sujet);
    $body = $txt;
    $mail->Body = html_entity_decode($body);
    $mail->AltBody = html_entity_decode(strip_tags($body));
    $mail->send();

    $data['success']['response'] = 'Message has been sent';
    echo json_encode($data);
} catch (Exception $e) {
  $data['failed']['response'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  echo json_encode($data);
}

?>
