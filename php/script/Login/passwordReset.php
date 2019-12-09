<?php
session_start();
/** Script qui reset le mot de passe d'un utilisateur
* 2019-10-27
* Maxime
* Le email va surement être recu dans les courriers indésirable puisqu'il n'est pas envoyé à
* partir d'un serveur mail
* ATTENTION: SI avast est installé sur votre machine, le mail ne pourra pas s'envoyer en localhost
**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/Exception.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/vendor/phpmailer/phpmailer/src/OAuth.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/connexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Client/GestionLogin.php';

$gestionLogin = new GestionLogin();

if(isset($_POST['courriel'])){
  $courriel = $_POST['courriel'];
}
else{
  $courriel = null;
  $_SESSION['msgPassword'] = "Le courriel n'a pas pu être envoyé. Une erreur s'est produite.";
  header("Location: /Project-Ekah/affichage/global/password-reset.php");
}

//Si le courriel n'existe pas, message d'erreur
if(!$gestionLogin->compteExiste($courriel)){
  $_SESSION['msgPassword'] = "Le courriel n'a pas pu être envoyé. Une erreur s'est produite.";
  header("Location: /password-reset");
}

/* Créer un password aléatoire de 8 charactère avec au moins 1 chiffre et 1 lettre majuscule */
$minuscule = 'abcefghijklmnopqrstuvwxyz';
$majuscule = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$nombre = '0123456789';
$mix = substr(str_shuffle($minuscule), 0, 7).substr(str_shuffle($nombre),0,1).substr(str_shuffle($majuscule),0,1);
$password_clair = str_shuffle($mix);
$password_hash = password_hash($password_clair, PASSWORD_ARGON2I);

/* Change le mot de passe dans la BD */
$conn = ($ctemp = new Connexion())->do();
$stmt = $conn->prepare("UPDATE compte_utilisateur SET mot_de_passe = ? WHERE courriel = ?");
$stmt->bind_param('ss', $password_hash, $courriel);
$stmt->execute();

/*echo $password_clair;
echo "<br>";
echo $password_hash;*/

$mail = new PHPMailer(true);  // Passing `true` enables exceptions
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'quoted-printable';

$sujet = "Demande de mot de passe oublié";

//Message dans le email
$txt = utf8_encode("Nous avons reçu une demande de mot de passe oublié. Si vous n'avez pas fait cette demande, veuillez ignorer ce courriel.<br>
                  Voici votre nouveau mot de passe: ".$password_clair."<br>
                  Veuillez changer de mot de passe lors de votre prochaine connexion.");

try {
    //Server settings
    //$mail->SMTPDebug = 2;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ekahinfo@gmail.com';               // SMTP username
    $mail->Password = 'Facilitateur2019';                 // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ekahinfo@gmail.com');
    $mail->addAddress($courriel); // Add a recipient
                                                          // Name is optional
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = html_entity_decode($sujet);
    $body = $txt;
    $mail->Body = html_entity_decode($body);
    $mail->AltBody = html_entity_decode(strip_tags($body));

    $mail->send();

    $_SESSION['msgPassword'] = "Un courriel vous a été envoyé.";
    header("Location: /password-reset");
} catch (Exception $e) {
  $_SESSION['msgPassword'] = "Le courriel n'a pas pu être envoyé. Une erreur s'est produite.";
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  header("Location: /password-reset");
}


?>
