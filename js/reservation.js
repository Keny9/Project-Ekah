/**
 * Page JS pour la reservation
 *
 * Nom :         reservation.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-10-11
 */

$(document).ready(function() {
  $(window).keydown(function(event){ //S'assure que le user ne peut pas envoyer le form avec un enter
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  // FORM SUBMIT
  $('#btnSuivant').click(function(){
    clickSuivant();
  });
});

function clickSuivant(){
  $('#form-reservation').attr('action', '/Project-Ekah/php/script/Reservation/redirectQuestionnaire.php');
  $('#form-reservation').submit();
}
