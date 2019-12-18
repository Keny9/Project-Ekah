
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

  $('#btn-confirm-reservation').click(closeModal);

});

// Redirect le client après avoir fait sa réservation
function redirect(){
  submitQuestionnaire();
}

// Soumet les infos à la BD
function submitQuestionnaire(){
  // Get les réponses au questions
  var suivi_string = "";
  $('#form-questions').find('div').each(function(){
    suivi_string += $(this).children().first().text();
    suivi_string += "\n";
    suivi_string += $(this).children().first().next().val();
    suivi_string += "\n\n";
  });

// TODO: faire l'url
// TODO: remettre le script redirectionQuestionnaire À défaut
  $.ajax({
    url: "/Project-Ekah/php/script/Reservation/updateSuivi.php",
    async: false,
    data: {fait: suivi_string,
           commentaire: "",
           id_suivi: SUIVI_ID},
    success: function(data) {
      openModal();
    } ,
    error: function() {
      alert('Error occured');
    }
  });
}

//Fermer la fenetre modale de modification d'une réservation
function closeModal(){
  $("#modal-question-reservation").css("display", "none");
  window.location = "/accueil";
}

//Ouvrir la fenêtre modal
function openModal(){
  $("#modal-question-reservation").css("display", "block");
}
