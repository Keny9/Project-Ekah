<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/stripe-php-7.13.0/vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/utils/connexion.php";
\Stripe\Stripe::setApiKey('sk_test_NZqmLN0M3rIysRWEpo5xza8J00PZodFzrb');

$conn;
$utilisateur_id = $_SESSION['logged_in_user_id'];
$videos_id = $_POST['videos_id'];

// try { // Bloc de paiement
//   $token = $_POST['token'];
//   $client_courriel = $client['courriel'];
//
//   $charge = \Stripe\Charge::create([
//       'amount' => $prix,
//       'currency' => 'cad',
//       'description' => 'Facturation d\'une réservation',
//       'source' => $token,
//   ]);
//
// } catch (Exception $e) {
//   echo 'Status is: ' . $e->getHttpStatus() . '<br>';
//   echo 'Type is: ' . $e->getError()->type . '<br>';
//   echo 'Code is: ' . $e->getError()->code . '<br>';
//   echo 'Param is: ' . $e->getError()->param . '<br>';
//   echo 'Message is: ' . $e->getError()->message . '<br>';
//   exit();
// }

$conn = ($temp = new Connexion())->do();
$req = "INSERT INTO videos_client (utilisateur_id, videos_id) VALUES (?, ?);";
$stmt = $conn->prepare($req);
$stmt->bind_param('ii', $utilisateur_id, $videos_id);
$stmt->execute();

echo "<br><br>done<br><br>";

?>
