
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
  submitQuestionnaire();
  //window.location = "/Project-Ekah/affichage/client/accueil_client.php";
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

alert(suivi_string);
// TODO: faire l'url
// TODO: remettre le script redirectionQuestionnaire À défaut
  $.ajax({
    url: "../../php/script/Reservation/updateSuivi.php",
    type:"POST",
    async: false,
    data: {fait: suivi_string,
           commentaire: "",
           id_suivi: ""},
    success: function(data) {
      console.log(data);
      if(!data){
          alert("La modification s'est effectuée avec succès!");
      }
      else{
        //  document.getElementById('erreurIdentifiant').innerHTML="L'identifiant existe déjà";
          console.log(data);
      }
    } ,
    error: function() {
      alert('Error occured');
    }
  });
}
