<?php
/**
 *  Script qui sert à rediriger l'utilisateur après s'être authentifier
 *  sur la page login.php.
 *
 * Nom :         redirectPostLogin.php
 * Catégorie :   scriptPhp
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-10-07
 */

 include_once $_SERVER['DOCUMENT_ROOT']."/Project-Ekah/php/gestionnaire/Client/GestionLogin.php";
 session_start();

 $gestionLogin = new GestionLogin();
 $messageErreur = "";

// TODO Devrait-il y avoir une autre vérification de mot de passe dans ce script?

 // Si le courriel n'est pas vide
 if (isset($_POST['courriel'])){
   $courriel = $_POST['courriel'];

   //Si le courriel entré existe dans la BD
   if(null !== ($tempArray = $gestionLogin->getUserIdAndUserTypeId($courriel))){
     // Set le user ID
     if(isset($tempArray[0])) $userId = $tempArray[0];
     else{$messageErreur .= "Problème avec le userId; <br>";}

     // Set le user type ID
     if (isset($tempArray[1])) $userTypeId = $tempArray[1];
     else{$messageErreur.= "Problème avec le userTypeId; <br>";}
   }
   else{
     $messageErreur .= "Le courriel existe pas dans la BD;<br>";
   }
 }
 else{
   $messageErreur .= "Le courriel est vide";
 }

 // Si aucune erreur,
 // Set userId et userTypeId dans la $_SESSION
 if (empty($messageErreur)){
   $_SESSION['userId'] = $userId;
   $_SESSION['userTypeId'] = $userTypeId;

   //Vérification du type d'utilisateur et redirect
   switch ($userTypeId) {
     case '1': // Si c'est un client
     header("Location: /Project-Ekah/affichage/client/accueil_client.php");
     break;
     case '2': // Si c'est un admin
     header("Location: /Project-Ekah/affichage/admin/accueil_admin.php");
     break;
     default: // Sinon (ne devrais pas se produire, mais doit quand même être géré)
     echo "Une erreur est survenue dans le switch.";
     session_destroy();
     break;
   }
 }
 else{
   session_destroy();
   echo $messageErreur;
 }
 ?>
