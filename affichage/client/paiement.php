<?php
session_start();
$page_type=1;
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Login/connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Horaire/gestionHoraire.php';
$gh = new GestionHoraire();

$id_dispo = $_GET['id_dispo'];
if (!$gh->getDispo($id_dispo)){ // Dispo n'est plus disponible
  echo"Dispo n'est plus disponnible.".'<br>';
  echo "<a href='accueil_client.php'>Retour à l'accueil</a>";
  exit();
}

// Retourne $client
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Client/getMonProfil.php';

$id_activite = $activite_id = $_POST['service'];
$date_rendez_vous = $_GET['date_rendez_vous'];
$id_facilitateur = $facilitateur_id = $_GET['facilitateur_id'];

$no_adresse = $_POST['noAdresse'];
$rue = $_POST['rue'];
$ville = $_POST['ville'];
$duree = $_GET['duree'];
if(isset($_POST['region'])) $id_region = $_GET['id_region'];
else $id_region = null;
$_SESSION['id_activite'] = $id_activite;
$_SESSION['date_rendez_vous'] = $date_rendez_vous;
$_SESSION['id_facilitateur'] = $id_facilitateur;
$_SESSION['id_dispo'] = $id_dispo;
$_SESSION['no_adresse'] = $no_adresse;
$_SESSION['rue'] = $rue;
$_SESSION['ville'] = $ville;
$_SESSION['duree'] = $duree;
$_SESSION['id_region'] = $id_region;
$_SESSION['client'] = $client;

$dt = new DateTime($date_rendez_vous);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i');

// retourne $service_nom
include $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/script/Reservation/paiement-getInfoReservation.php";
if($id_type_activite == 3) $emplacement = "En ligne";
else $emplacement = $no_adresse." ".$rue.", ".$ville;
// retourne $prix
include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/script/Reservation/getPrix.php';
$_SESSION['prix'] = $prix;

$prix_format = number_format($prix*0.01, 2, ',', '');
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <title></title>
   <link rel="stylesheet" href="../../css/stripe_css.css">
   <script src="https://js.stripe.com/v3/"></script>
   <script type="text/javascript" src="../../js/paiement.js"></script>

 </head>
 <body>
   <div class="body-container">
     <div class="top">
        <img src="../../img/powered_by_stripe.png" alt="Powered by Stripe" title="Powered by Stripe">
     </div>
     <div class="body">
       <div class="header">
         <div class="item">
           <img class="logo" src="../../img/icon_ekah.png" alt="Ekah Logo" title="Logo d'Ekah">
         </div>
         <div class="item">
           <label>Formulaire de paiement</label>
         </div>
         <div class="item">
           <label>Collectif Ekah 2019</label>
         </div>
       </div>

       <div class="main">
         <div class="info-container">
           <div class="item">
             <label>Individu :</label>
             <span><?php echo $client['prenom']." ".$client['nom'] ?></span>
           </div>
           <div class="item">
             <label>Service :</label>
             <span><?php echo $service_nom ?></span>
           </div>
           <div class="item">
             <label>Date :</label>
             <span><?php echo $date ?></span>
           </div>
           <div class="item">
             <label>Heure :</label>
             <span><?php echo $time ?></span>
           </div>
           <div class="item">
             <label>Durée :</label>
             <span><?php echo $duree ?> minutes</span>
           </div>
           <div class="item">
             <label>Lieu :</label>
             <span><?php echo $emplacement ?></span>
           </div>
           <div class="item">
             <label>Montant :</label>
             <span><?php echo $prix_format ?> $ CAD</span>
           </div>
         </div>
       </div>

       <div class="main">
         <form action="../../php/script/Reservation/redirectQuestionnaire.php" method="post" id="payment-form">
           <input type="hidden" name="token" />
           <div class="group">
             <label>
               <span>Numéro de carte</span>
               <div id="card-number-element" class="field"></div>
             </label>
             <label>
               <span>Date d'expiration</span>
               <div id="card-expiry-element" class="field"></div>
             </label>
             <label>
               <span>CVC</span>
               <div id="card-cvc-element" class="field"></div>
             </label>
             <label>
               <span>Code postal</span>
               <input id="postal-code" name="postal_code" class="field" placeholder="J1N 1Z1" />
             </label>
           </div>
           <div class="error"></div>
           <button type="submit">Payer <?php echo $prix_format ?> $</button>

         </form>
       </div>
     </div>
     <div class="bottom">
       <img src="../../img/logo_ekah_header.png" alt="Ekah logo" title="Logo d'Ekah">
     </div>
   </div>

 </body>
 </html>
