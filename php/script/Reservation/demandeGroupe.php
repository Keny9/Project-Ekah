<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/PHPMailer-master/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/PHPMailer-master/src/Exception.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/PHPMailer-master/src/OAuth.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'karlboutin98@gmail.com';                 // SMTP username
    $mail->Password = '???';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('test@live.com', 'George');
    $mail->addAddress('elec19981109@gmail.com', 'Joe');     // Add a recipient
                                                            // Name is optional
    $body = "<p>Would you love for it to work god damnit</p>";

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Le mail test';
    $mail->Body    = 'Would you love for it to work god damnit';
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>
