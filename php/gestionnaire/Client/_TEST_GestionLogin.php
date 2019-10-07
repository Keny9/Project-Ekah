<?php
include_once 'GestionLogin.php';

$gestion = new GestionLogin();

$motDePasse = "Qwertyu1";
$courriel = "maxlussier.22@gmail.uu";

echo $gestion->utilisateurExiste($courriel, $motDePasse);


 ?>
