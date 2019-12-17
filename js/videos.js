document.addEventListener("DOMContentLoaded", function() {
    eventListeners();
});

$(document).ready(function(){

  var player = videojs('video-1');

  player.brand({
  	image: "/ekah-logo.png",
    title: "Ekah",
    destination: "www.ekah.co",
    destinationTarget: "_top"
  });
  player.poster(VIDEOS[0]['poster']);

  var player2 = videojs('video-2');

  player2.brand({
  	image: "/ekah-logo.png",
    title: "Ekah",
    destination: "www.ekah.co",
    destinationTarget: "_top"
  });
  player2.poster(VIDEOS[1]['poster']);

  var player3 = videojs('video-3');

  player3.brand({
  	image: "/ekah-logo.png",
    title: "Ekah",
    destination: "www.ekah.co",
    destinationTarget: "_top"
  });
  player3.poster(VIDEOS[2]['poster']);

// disable browser context menu on video
preventRightClick();

addEventBtn();

// Les prochaines lignes font la distinction entre les videos achetées/non-achetées par le client
// Ce n'est pas la manière propre de faire
  v1 = v2 = v3 = false;
  VIDEOS_CLIENT.forEach(function(e){
    console.log(e);
    if(e == 1) v1 = true;
    if(e == 2) v2 = true;
    if(e == 3) v3 = true;
  });

  if(v1 == false){
    $("#video-1").html("<div class='shade'></div><p class='video-locked' style='background:url(\""+VIDEOS[0]['poster']+"\") no-repeat center;background-size: cover;'><p class='txt-centered'>Vous ne posséder pas cette vidéo</p></p>");
    $("#btn-video-1").show();
  }
  if(v2 == false){
    $("#video-2").html("<div class='shade'></div><p class='video-locked' style='background:url(\""+VIDEOS[1]['poster']+"\") no-repeat center;background-size: cover;'><p class='txt-centered'>Vous ne posséder pas cette vidéo</p></p>");
    $("#btn-video-2").show();
  }
  if(v3 == false){
    $("#video-3").html("<div class='shade'></div><p class='video-locked' style='background:url(\""+VIDEOS[2]['poster']+"\") no-repeat center;background-size: cover;'><p class='txt-centered'>Vous ne posséder pas cette vidéo</p></p>");
    $("#btn-video-3").show();
  }

});

function eventListeners(){
  eventListenerNav();
}

function eventListenerNav(){
  var links = document.querySelector(".folder-nav").querySelectorAll("a");

  links.forEach(function(link){
    link.addEventListener("click", function(){
      links.forEach(e => e.style.color = "rgba(26,26,26,.4)");
      links.forEach(e => e.classList.remove("selected"));
      link.classList.add("selected");
    });

    link.addEventListener("mouseover", function(){
      link.style.color = "#1a1a1a";
    });

    link.addEventListener("mouseout", function(){
      link.style.color = "rgba(26,26,26,.4)";
    });
  });
}

// disable browser context menu on video
function preventRightClick(){
  video = $("#video-1");
  video.on('contextmenu', function(e) {
      e.preventDefault();
  });

  video = $("#video-2");
  video.on('contextmenu', function(e) {
      e.preventDefault();
  });

  video = $("#video-3");
  video.on('contextmenu', function(e) {
      e.preventDefault();
  });
}

//Ajouter action listeners sur les boutons
function addEventBtn(){
    $('#btn-video-1').click(function(){
      $("#modal-paiement-video").show();
    });

    $('#btn-video-2').click(function(){
      $("#modal-paiement-video").show();
    });

    $('#btn-video-3').click(function(){
      $("#modal-paiement-video").show();
    });

    $("#btn-close").click(function(){
      $("#modal-paiement-video").hide();
    });

    $("#btn-confirm-video").click(function(){
      $("#modal-complete-video").hide();
    });
}
