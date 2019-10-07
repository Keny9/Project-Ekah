/**
 * Page JS pour login
 *
 * Nom :         login.js
 * Catégorie :   JavaScript
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-10-06
 */

$( document ).ready(function() {
    $('#btnlogin').click(function(){
      if(validerLogin()){
        $('#formulaireLogin').attr('action', '_TEST_login.php');
        $('#formulaireLogin').submit();
      }
    });
});

function validerLogin(){
  var bool = false;
  //alert($('#courriel').val());
  $.ajax({
    type: "POST",
    async: false,
    url: "../../php/script/Client/validerLogin.php",
    data: {"courriel": $('#courriel').val(),
           "motDePasse": $('#motDePasse').val()},
    success: function(result){
      if(result == "Bon courriel bon mot de passe"){
        bool = true;
      }
      alert(result);
      /*else if(result == "Bon courriel mauvais mot de passe"){
        alert(result);
      }
      else {
        alert("erreur survenue : " + result);
      }*/
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}
