<?php
/**
* Paiement d'une vidéo
*
* Nom :         redirectQuestionnaire
* Catégorie :   scriptPhp
* Auteur :      Maxime Lussier
* Version :     1.1
* Date de la dernière modification : 2019-12-03
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/connexion.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Video/GestionVideo.php';
require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/stripe-php-7.13.0/vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE){session_start();}

\Stripe\Stripe::setApiKey('sk_test_NZqmLN0M3rIysRWEpo5xza8J00PZodFzrb');

$client =           $_SESSION['client'];
$idVideo = $_POST['id-video'];
$prix = $_POST['prix-video'];

unset($_SESSION['client']);

$gVideo = new GestionVideo();

try { // Bloc de paiement
  $token = $_POST['token'];
  $client_courriel = $client['courriel'];

  $charge = \Stripe\Charge::create([
      'amount' => $prix,
      'currency' => 'cad',
      'description' => 'Facturation d\'une vidéo',
      'source' => $token,
      'receipt_email' => $client_courriel,
  ]);

} catch (Exception $e) {
  echo 'Status is: ' . $e->getHttpStatus() . '<br>';
  echo 'Type is: ' . $e->getError()->type . '<br>';
  echo 'Code is: ' . $e->getError()->code . '<br>';
  echo 'Param is: ' . $e->getError()->param . '<br>';
  echo 'Message is: ' . $e->getError()->message . '<br>';
  exit();
}

$_SESSION['recu_paiement_url'] = $charge['receipt_url'];
$recu_url = $charge['receipt_url'];

$gVideo->ajouterVideoClient($idVideo,$client['id']);

header('Location: /videos?vComplete=1&recu_url='.$recu_url);




?>
