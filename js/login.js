/**
 * Page JS pour login
 *
 * Nom :         login.js
 * Catégorie :   JavaScript
 * Auteur :      Maxime Lussier
 * Version :     1.1
 * Date de la dernière modification : 2019-10-07
 */

$( document ).ready(function() {
 courriel = document.getElementById("courriel");
 motDePasse = document.getElementById("motDePasse");
 div = document.createElement('div'); //New div erreur
 p = document.createElement('p'); //p dans le div erreur

 div.id = "error-login";
 div.className = "error-login";

 // FORM SUBMIT
 $('#btnlogin').click(function(){
   if(validerLogin()){
     $('#formulaireLogin').attr('action', '/Project-Ekah/php/script/Client/redirectPostLogin.php');
     $('#formulaireLogin').submit();
   }
   else{
     return false;
   }
 });
});

function validerLogin(){
  var bool = false;

  if(siVide(courriel) || siVide(motDePasse)){
    p.innerHTML = "Vous ne devez pas laisser les champs vide."; //MESSAGE À RÉSONANCE PLUS POSITIVE ,ex : Les deux champs doivent être remplis.
    document.getElementById("logo").parentNode.insertBefore(div, document.getElementById("logo").nextSibling);
    div.appendChild(p);
    return bool;
  }

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
      else if(result == "Bon courriel mauvais mot de passe" || result == "Courriel existe pas"){
        p.innerHTML = "Votre adresse courriel ou votre mot de passe est invalide.";
        document.getElementById("logo").parentNode.insertBefore(div, document.getElementById("logo").nextSibling);
        div.appendChild(p);
      }
    },
    error: function (jQXHR, textStatus, errorThrown) {
        alert("An error occurred whilst trying to contact the server: " + jQXHR.status + " " + textStatus + " " + errorThrown);
    }
  });
  return bool;
}

//Verifie si le champ de l'element est vide
function siVide(e){
  if(e.value == null || e.value == ""){
    return true;
  }
  return false;
}
