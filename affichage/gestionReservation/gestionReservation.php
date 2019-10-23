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
  <link rel="shortcut icon" href="../../img/favicon-ekah.ico" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" href="../../css/gestionReservation.css">
  <link rel="stylesheet" href="../../css/main.css">
  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
  <script type="text/javascript" src="../../js/gestionReservation.js"></script>
  <title>Gestion Reservation</title>
</head>

<body>
<main>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/header.php' ?>

  <h1 class="titreReservation">Gestion des Réservation</h1>
    <div class="tableauActivite">
    <?php
                   require_once 'gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllActivite();
                 ?>
                 <input type="button" class="submitSupprimer" onclick="supprime();" value="Supprimer" />
                 <input type="button" class="submitAjout" onclick="ajouter();" value="Ajouter" /></br>
                 <input type="button" class="submitModifier" onclick="modifier();" value="Modifier" />
    </div>

    <div class="reservationMain">
      <div class="reservationHeader"><img class="imgHeader"src="../../img/logo_ekah_header.png" alt="Ekah"></div>
      <div class="reservationImg"><img class="imgPrincipal"src="../../img/imgDehors.jpg" alt="Soins a domicile"> <div class="titreImg" id="titre">Soins a domicile</div></div>
      <h2 class="reservez texteEkha">Réservez dès maintenant</h2></br>
      <h6 class="choisirServ texteEkha">Choisir un service:</h6>
      <h6 class="choisirDuree texteEkha">Quelles durées sont acceptées:</h6></br></br>
      <textarea class="boxService" name="service" id="nom">
        Soins a domicile
      </textarea>
      <div class="tableauDuree">
      <?php
                     require_once 'gestionAffichageGestionReservation.php';
                     $gagr = new GestionAffichageGestionReservation();
                     echo $gagr->getAllDuree();
                   ?>

    </div>

    <h6 class="choisirType texteEkha">Quelle est le type de l'activité:</h6></br></br>
    <?php
                   require_once 'gestionAffichageGestionReservation.php';
                   $gagr = new GestionAffichageGestionReservation();
                   echo $gagr->getAllTypeActivite();
                 ?>

    <h6 class="duree texteEkha">Duree:</h6>
    <select class="boxDuree" name="service">
      <option value="Duree">1 heures</option>
    </select>
    <h6 class="prix texteEkha">Prix:</h6>
    <input class="boxDuree" type="text" name="prix" min="0" value="Non fonctionelle scrum 1"></input>
    <h6 class="descriptionC texteEkha">Description du service:</h6>
    <textarea class="boxDescription" type="text" name="descriptionC" cols="40" rows="5" id="descriptionC"></textarea>
    <h4 class="descriptionC texteEkha">Ajouter des questions specifique</h6>
      <input class="inputId" type="text"  placeholder="Id" id="idQuestion"></input>
      <input class="inputQuestion" type="text"  placeholder="Question" id="question"></input>
      <input class="inputNb" type="text"  placeholder="Nombre de lignes de la case" id="nbLigne"></input>
      <input class="inputType" type="text"  placeholder="Type de la question" id="typeQuestion"></input>
      <input type="button" class="submitAjoutQuestion" onclick="ajouterQuestion();" value="Ajouter" />

</main>
<?php include $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/affichage/global/footer.php' ?>
</body>

</html>

<?php
  unset($_SESSION["error"]);
 ?>
