document.addEventListener("DOMContentLoaded", function() {
    eventListeners();
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
