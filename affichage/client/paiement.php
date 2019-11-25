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
$prix = 10000;//formule magique
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
$prix
$id_region");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/paiement.css">
    <script type="text/javascript" src="../../js/jquery-3.4.1.slim.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
      const prix = <?php echo $prix; ?>;
    </script>
    <script type="text/javascript" src="../../js/paiement.js"></script>
  </head>
  <body>
    <form action="/Project-Ekah/php/script/Reservation/redirectQuestionnaire.php?" method="post" id="payment-form">
      <div class="form-row">
        <label for="card-element">
          Crédit ou débit
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>
        <div id="prix">
          <label><?php echo $prix ?></label>
          <input type="hidden" name="total" id="total" value="<?php echo $prix ?>">
        </div>

        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button>Soumettre paiement</button>
    </form>
  </body>

  </html>
