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

  var player2 = videojs('video-2');

    player2.brand({
    	image: "/ekah-logo.png",
      title: "Ekah",
      destination: "www.ekah.co",
      destinationTarget: "_top"
    });

  var player3 = videojs('video-3');

    player3.brand({
    	image: "/ekah-logo.png",
      title: "Ekah",
      destination: "www.ekah.co",
      destinationTarget: "_top"
    });

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
