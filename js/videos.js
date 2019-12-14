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
  $video = $("#video-1");
  $video.on('contextmenu', function(e) {
      e.preventDefault();
  });

  $video = $("#video-2");
  $video.on('contextmenu', function(e) {
      e.preventDefault();
  });

  $video = $("#video-3");
  $video.on('contextmenu', function(e) {
      e.preventDefault();
  });

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
    $("#video-1").html("<p style='height:100%;text-align:center;line-height:400px;font-size:40px;background-image:url(\""+VIDEOS[0]['poster']+"\");'>Vous devez acheter la video</p>");
  }
  if(v2 == false){
    $("#video-2").html("<p style='height:100%;text-align:center;line-height:400px;font-size:40px;background-image:url(\""+VIDEOS[1]['poster']+"\");'>Vous devez acheter la video</p>");
  }
  if(v3 == false){
    $("#video-3").html("<p style='height:100%;text-align:center;line-height:400px;font-size:40px;background-image:url(\""+VIDEOS[2]['poster']+"\");'>Vous devez acheter la video</p>");
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
