<?php
  session_start();

  require_once("../../php/gestionnaire/Activite/gestionActivite.php");
  require_once("../../php/gestionnaire/Duree/gestionDuree.php");

  //if(!isset($_SESSION["admin"]) || !isset($_SESSION["user"])){
  //  header("location: page_connexion.php");
  //}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" href="../../css/gestionReservation.css">
  <link rel="stylesheet" href="../../css/main.css">
  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="../../js/gestionReservation.js"></script>
  <title>Gestion Reservation</title>
</head>

<body>
<main>

  <h1 class="titreReservation">Gestion des Réservation</h1>
    <div class="tableauActivite">
    <?php
                   require_once 'gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllActivite();
                 ?>
                 <input type="button" class="submitSupprimer" onclick="supprime();" value="Supprimer" />
                 <input type="button" class="submitAjout" onclick="ajOuMod();" value="Ajouter" /></br>
                 <input type="button" class="submitModifier" onclick="ajOuMod();" value="Modifier" />
    </div>


    <div class="reservationMain">
      <div class="reservationHeader"><img class="imgHeader"src="../../img/logo_ekah_header.png" alt="Ekah"></div>
      <div class="reservationImg"><img class="imgPrincipal"src="../../img/imgDehors.jpg" alt="Soins a domicile"> <div class="titreImg">Soins a domicile</div></div>
      <h2 class="reservez texteEkha">Réservez dès maintenant</h2></br>
      <h6 class="choisirServ texteEkha">Choisir un service:</h6>
      <h6 class="choisirDuree texteEkha">Quelles durées sont acceptées:</h6></br></br>
      <select class="boxService" name="service">
        <option value="Soins">Soins a domicile</option>
      </select>
      <div class="tableauDuree">
      <?php
                     require_once 'gestionAffichageGestionReservation.php';
                     $gagr = new GestionAffichageGestionReservation();
                     echo $gagr->getAllDuree();
                   ?>

    </div>
    <h6 class="duree texteEkha">Duree:</h6>
    <select class="boxDuree" name="service">
      <option value="Duree">1 heures</option>
    </select>
    <h6 class="prix texteEkha">Prix:</h6>
    <input class="boxDuree" type="number" name="prix" min="0">
</main>
</body>

</html>

<?php
  unset($_SESSION["error"]);
 ?>
