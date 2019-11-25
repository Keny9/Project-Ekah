<?php
session_start();
$page_type=1;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';

$id_activite = $_POST['service'];
$date_rendez_vous = $_GET['date_rendez_vous'];
$id_facilitateur = $_GET['facilitateur_id'];
$id_dispo = $_GET['id_dispo'];
$no_adresse = $_POST['noAdresse'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$duree = $_GET['duree'];
if(isset($_POST['region'])){ $id_region = $_GET['id_region'];}
else{$id_region = null;}
// TODO: faire les validations des variables pour être sûr que la Réservation puisse se créer sans erreur après le paiement
$_SESSION['id_activite'] = $id_activite;
$_SESSION['date_rendez_vous'] = $date_rendez_vous;
$_SESSION['id_facilitateur'] = $id_facilitateur;
$_SESSION['id_dispo'] = $id_dispo;
$_SESSION['no_adresse'] = $no_adresse;
$_SESSION['rue'] = $rue;
$_SESSION['ville'] = $ville;
$_SESSION['duree'] = $duree;
$_SESSION['id_region'] = $id_region;

// Pour les tests
echo nl2br("$id_activite
$date_rendez_vous
$id_facilitateur
$id_dispo
$no_adresse
$rue
$ville
$duree
$id_region");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/paiement.css">
  </head>
  <body>
    <form action="/Project-Ekah/php/script/Reservation/redirectQuestionnaire.php?" method="post" id="payment-form">
      <div class="form-row">
        <label for="card-element">
          Credit or debit card
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <div id="prix">
          <input type="number" name="total" value="">
        </div>

        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button>Submit Payment</button>
    </form>
  </body>
  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">

  var stripe = Stripe('pk_test_nexEKdAh5yqBBuHujvFYAwpq00HQmYWpWf');
  var elements = stripe.elements();

  function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

  // Custom styling can be passed to options when creating an Element.
  var style = {
    base: {
      // Add your base input styles here. For example:
      fontSize: '16px',
      color: "#32325d",
    }
  };

  // Create an instance of the card Element.
  var card = elements.create('card', {style: style});

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  // Create a token or display an error when the form is submitted.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Inform the customer that there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
      }
    });
  });
  </script>
  </html>
