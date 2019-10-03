/**
 * Page JS pour inscription
 *
 * Nom :         inscription.js
 * Catégorie :   JavaScript
 * Auteur :      Karl Boutin
 * Version :     1.0
 * Date de la dernière modification : 2019-09-30
 */

//Lorsque le document est prêt
var valide = true;

window.onload = function(){
  prenom = document.getElementById("prenom");
  nom = document.getElementById("nom");
  courriel = document.getElementById("courriel");
  telephone = document.getElementById("telephone");
  motDePasse = document.getElementById("motDePasse");

  prenom.addEventListener("focusout", function(){
    if(verifieNomPrenom(prenom)){
      inputUnrequired(prenom, "Prénom");
    }
  });

  nom.addEventListener("focusout", function(){
    if(verifieNomPrenom(nom)){
      inputUnrequired(nom, "Nom");
    }
  });

  courriel.addEventListener("focusout", function(){
    if(verifieCourriel(courriel)){
      inputUnrequired(courriel, "Courriel");
    }
  });

  telephone.addEventListener("focusout", function(){
    if(verifieTelephone(telephone)){
      inputUnrequired(telephone, "Courriel");
    }
  });

  motDePasse.addEventListener("focusout", function(){
    if(verifieMotDePasse(motDePasse)){
      inputUnrequired(motDePasse, "Mot de passe");
    }
  });
};

//Fonction si input vide qui montre que le champ est requis
 function inputRequired(e){
    e.style.borderBottomColor = "#ff0000";
    e.style.setProperty("--color", "#ff0000");
 }

//Fonction qui remet les couleurs par défauts
 function inputUnrequired(e, placeholder){
   e.style.borderBottomColor = "#9E9E9E";
   e.style.setProperty("--borderBottomColor", "#f0592a");
   e.style.setProperty("--color", "#C8C8C8");
   e.placeholder = placeholder;
 }

 //Change la couleur du texte lorsqu'on sélectionne un élément de la liste mois
 function changeMois(){
   var list = document.getElementById("mois");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

//Change la couleur du texte lorsqu'on sélectionne un élément de la liste pays
 function changePays(){
   var list = document.getElementById("pays");
   var selectedValue = list.options[list.selectedIndex].value;

   if(selectedValue != "vide"){
     list.style.color = "#000000";
   }
 }

 //Fonction qui valide le formulaire avant de submit
 function validerFormInscription(){

   if(siVide(prenom) || siVide(nom) || siVide(courriel) || siVide(telephone) || siVide(motDePasse)){
     indiqueChampVide();
     document.getElementById("error-blank").style.display = "block";
     return false;
   }
   else{
     document.getElementById("error-blank").style.display = "none";
   }

   if(!verifieNomPrenom(prenom) || !verifieNomPrenom(nom) || !verifieCourriel(courriel) || !verifieTelephone(telephone) || !verifieMotDePasse(motDePasse)){
     indiqueChampInvalide();
     return false;
   }


   return false;
 }

 //Verifie que le nom de famille ou le prenom est valide (Regex)
 function verifieNomPrenom(e){
   var nomRegex = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$/;
   return nomRegex.test(e.value);
 }

//Verifie que le jour est valide. Si le jour est d'une longueur de 1 ou 2 et que c'est numérique
 function verifieJour(e){
   var jourRegex = /^[0-9]{1,2}$/;
   return jourRegex.test(e.value);
 }

//Valider que l'annee entree contient 4 chiffres et qu'il est numerique
 function verifieAnnee(e){
   var anneeRegex = /^[0-9]{4}$/;
   return anneeRegex.test(e.value);
 }

//Verifier que le courriel est valide
 function verifieCourriel(e){
   var courrielRegex = /^\S+@\S+\.\S+$/;
   return courrielRegex.test(e.value);
 }

//S'assurer que le code postal est valide selon le format Canadien pour l'instant
 function verifieCodePostal(e){
   var codePostalRegex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
   return codePostalRegex.test(e.value);
 }

//S'assurer que le mot de passe respecte certaines conditions (au moins 8 charactère, 1 minuscule, 1 majuscule et au moins 1 chiffre)
 function verifieMotDePasse(e){
   var motDePasseRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])[A-Za-z\d!@#$%^&*?]{8,}$/;
   return motDePasseRegex.test(e.value);
 }

//Veririfer que le numero de telephone entree est valide . Au moins 10 chiffres.
 function verifieTelephone(e){
   var telephoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
   return telephoneRegex.test(e.value);
 }

//Indique quels champs sont vides à l'utilisateur
 function indiqueChampVide(){

   if(siVide(prenom)){
     inputRequired(prenom);
   }

   if(siVide(nom)){
     inputRequired(nom);
   }

   if(siVide(courriel)){
     inputRequired(courriel);
   }

   if(siVide(telephone)){
     inputRequired(telephone);
   }

   if(siVide(motDePasse)){
     inputRequired(motDePasse);
   }

 }

//Indique quels champs sont invalides a l'utilisateur
 function indiqueChampInvalide(){

   if(!verifieNomPrenom(prenom)){
     inputRequired(prenom);
     prenom.value = null;
     prenom.placeholder = "Prénom invalide *";
   }

   if(!verifieNomPrenom(nom)){
     inputRequired(nom);
     prenom.value = null;
     prenom.placeholder = "Nom invalide *";
   }

   if(!verifieCourriel(courriel)){
     inputRequired(courriel);
     courriel.value = null;
     courriel.placeholder = "Courriel invalide *";
   }

   if(!verifieTelephone(telephone)){
     inputRequired(telephone);
     telephone.value = null;
     telephone.placeholder = "Téléphone invalide *";
   }

   if(!verifieMotDePasse(motDePasse)){
     inputRequired(motDePasse);
     motDePasse.value = null;
     motDePasse.placeholder = "Mot de passe invalide *";
     document.getElementById("block-requis").style.border = "1px solid #eb0909";
   }
 }

 //Verifie si le champ de l'element est vide
 function siVide(e){
   if(e.value == null || e.value == ""){
     return true;
   }
   return false;
 }

//Affiche les exigences du mot de passe
 function afficheExigence(){
   document.getElementById("block-requis").style.display = "block";
 }
