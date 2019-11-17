/**
 * JS global
 * Contient les fonctions JS pour
 * le header, footer et nav
 *
 * Nom :         global.js
 * Catégorie :   JS
 * Auteur :      Karl Boutin et Maxime Lussier
 * Version :     1.2
 * Date de la dernière modification : 2019-11-16
 */
var clickNav = 0; //Nombre de click sur l'icone mobile pour le menu
var clickMenuMobile = 0; //Nombre de click sur le menu services mobile
var clickDropHeader = 0; //Nombre de click sur le dropdown menu du header
var clickedElement;
var resizeTimer;

$(document).ready(function() {
 typeMenu = $("#nav_m_type").val(); //Le titre de l'espace, soit client ou facilitateur selon le menu affiché

  //Afficher les sous-onglets avec une animation
  $("#folder_service").mouseenter(function(){
    $("#service_header").stop().slideDown("fast");
    $('#c-individu').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
    $('#c-equipe').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
  });

  $("#onglet_service").mouseleave(function(){
    $("#service_header").stop().slideUp("fast");
    $('#c-individu').css({opacity: 0.0, visibility: "hidden"});
    $('#c-equipe').css({opacity: 0.0, visibility: "hidden"});
  });

  $("#folder_retraite").mouseenter(function(){
    $("#retraite").stop().slideDown("fast");
    $('#c-francais').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
    $('#c-english').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
  });

  $("#onglet_retraite").mouseleave(function(){
    $("#retraite").stop().slideUp("fast");
    $('#c-francais').css({opacity: 0.0, visibility: "hidden"});
    $('#c-english').css({opacity: 0.0, visibility: "hidden"});
  });

  $("#folder_propos").mouseenter(function(){
    $("#propos").stop().slideDown("fast");
    $('#c-ekah').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
    $('#c-equipe-propos').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 1}, 200);
  });

  $("#onglet_propos").mouseleave(function(){
    $("#propos").stop().slideUp("fast");
    $('#c-ekah').css({opacity: 0.0, visibility: "hidden"});
    $('#c-equipe-propos').css({opacity: 0.0, visibility: "hidden"});
  });
/*--------------------------------------------------*/

/*Afficher les sous onglet dans le menu mobile*/
$("#folder_service_m").click(function(){
  checkIfOngletOuvert($("#folder_service_m").attr('id'));
  clickedElement = "folder_service_m";
  clickMenuMobile++;

  if(clickMenuMobile % 2 == 0){
    $("#service_m").hide();
    $("#folder_service_m").text("+ SERVICES");
  }
  else if(clickMenuMobile % 2 == 1){
    $("#service_m").show();
    $("#folder_service_m").text("- SERVICES");
  }
});

$("#folder_retraite_m").click(function(){
  checkIfOngletOuvert($("#folder_retraite_m").attr('id'));
  clickedElement = "folder_retraite_m";
  clickMenuMobile++;

  if(clickMenuMobile % 2 == 0){
    $("#retraite_m").hide();
    $("#folder_retraite_m").text("+ RETRAITES");
  }
  else if(clickMenuMobile % 2 == 1){
    $("#retraite_m").show();
    $("#folder_retraite_m").text("- RETRAITES");
  }
});

$("#folder_propos_m").click(function(){
  checkIfOngletOuvert($("#folder_propos_m").attr('id'));
  clickedElement = "folder_propos_m";
  clickMenuMobile++;

  if(clickMenuMobile % 2 == 0){
    $("#propos_m").hide();
    $("#folder_propos_m").text("+ À PROPOS");
  }
  else if(clickMenuMobile % 2 == 1){
    $("#propos_m").show();
    $("#folder_propos_m").text("- À PROPOS");
  }
});

$("#folder_espace_m").click(function(){
  checkIfOngletOuvert($("#folder_espace_m").attr('id'));
  clickedElement = "folder_espace_m";
  clickMenuMobile++;

  if(clickMenuMobile % 2 == 0){
    $("#espace_m").hide();
    $("#folder_espace_m").text("+ ESPACE " + typeMenu);
  }
  else if(clickMenuMobile % 2 == 1){
    $("#espace_m").show();
    $("#folder_espace_m").text("- ESPACE " + typeMenu);
  }
});


/*---------------------------------------------------------------*/

//Click sur icone mobile pour afficher le menu
$("#icon-mobile-menu").click(function(){
  windowWidth = $(window).width();
  clickNav++;
  $("#side-nav-m").toggle("slide");

  if(clickNav % 2 == 0){ //Ferme la navigation
    $("#nav-mobile").removeClass("nav-mobile-ouvert");
    $("#logoWrapper").removeClass("logo-ouvert-mobile");
  }
  else if(clickNav % 2 == 1){ //Ouvre la navigation
    $("#nav-mobile").addClass("nav-mobile-ouvert");
    if(windowWidth < 475){
      $("#logoWrapper").addClass("logo-ouvert-mobile");
    }
  }

  });

/*Click sur le dropdown menu du header pour un client ou un admin*/
  $("#header_drop").click(function(){
    clickDropHeader++;

    if(clickDropHeader % 2 == 0){ //Ferme le nav
      $("#header_nav").removeClass('nav_show');
      $("#header_nav").addClass('nav_hidden');
    }
    else if(clickDropHeader % 2 == 1){ //Ouvre le nav
      $("#header_nav").removeClass('nav_hidden');
      $("#header_nav").addClass('nav_show');
      $("#header_nav").focus();
    }

  });

});

/*Lorsqu'un click survient hors du menu, on le ferme*/
$(document).mouseup(function(e)
{
  //Cacher la boite de recherche lorsqu'il y a un click a l'exterieur
    if ($(e.target).closest("#side_menu").length === 0 && $("#header_nav").css('display') == "block"){
        $("#header_nav").removeClass('nav_show');
        $("#header_nav").addClass('nav_hidden');
    }
});

$(window).resize(function () {
  clearTimeout(resizeTimer);
  resizeTimer = setTimeout(resizePage, 100);
});

/*Fonction lorsqu'on resize la page
 Dependemment de la dimension de la page, on ajuste le header si c'est mobile ou non
*/
function resizePage(){
  windowWidth = $(window).width();

  if(windowWidth >= 1100){
    $("#side-nav-m").hide();
    $("#nav-mobile").removeClass("nav-mobile-ouvert");
    $("#logoWrapper").removeClass("logo-ouvert-mobile");
    clickNav = 0;
  }

  if(windowWidth >= 475){
    $("#logoWrapper").removeClass("logo-ouvert-mobile");
  }
}

//Verifier si un onglet est déja ouvert, si oui on ferme tout
function checkIfOngletOuvert(id){
  if(clickMenuMobile >= 1 && clickedElement != id){
    $("#service_m").hide();
    $("#folder_service_m").text("+ SERVICES");
    $("#retraite_m").hide();
    $("#folder_retraite_m").text("+ RETRAITES");
    $("#propos_m").hide();
    $("#folder_propos_m").text("+ À PROPOS");
    $("#espace_m").hide();
    $("#folder_espace_m").text("+ ESPACE " + typeMenu);
    clickMenuMobile = 0;
  }
}
