
<?php
// Script qui sert à valider la connexion d'un utilisateur
// 2019-10-27
// Maxime

include_once  $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/php/gestionnaire/Client/GestionLogin.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$gestionLogin = new GestionLogin();

// La session contient un utilisateur
if (isset($_SESSION['logged_in_user_id']) && !empty($_SESSION['logged_in_user_id'])){
  $user_id = $_SESSION['logged_in_user_id'];
  $user_type = $gestionLogin->getTypeId($user_id);
  // Le type d'utilisateur correspond au type de restriction
  if($user_type == $page_type){
    // L'utilisateur accède à la page
  }
  else{ // Montre alert JS  et  redirect sur login
    echo '<script type="text/javascript">
            alert("01.'.$user_type.$page_type.' Vous devez vous connecter pour accéder à cette page.");
            window.location.replace("/login");
          </script>';
  }

}
else{ // La session ne contient pas d'utilisateur
  // Montre alert JS  et  redirect sur login
  echo '<script type="text/javascript">
          alert("02. Vous devez vous connecter pour accéder à cette page.");
          window.location.replace("/login");
        </script>';
}
?>
