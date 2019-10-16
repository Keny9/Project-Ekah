
/**
 * Page JS pour le questionnaire de réservation
 *
 * Nom :         questionnaire.js
 * Catégorie :   JavaScript
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-14
 */

$(document).ready(function() {

  $('#confirmerQuestion').click(function(){
    // TODO: valider le form
    // TODO: ajouter la réservation avec ajax
    redirect();
  });
});

function submitForm(){
  // TODO: Affiche un message de confirmation de la réservation

}

// Redirect le client après avoir fait sa réservation
function redirect(){
  window.location = "/Project-Ekah/affichage/client/accueil_client.php";
}
