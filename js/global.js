
$( document ).ready(function() {
  // ajuste la positions des sous-menus
  $('.tab .subTab').each(function(){
    var $left = $(this).parent().offset().left;
    var $height = $(this).height();
    var $top = $(this).offset().top - $(this).height();
    var $this = this;

    $(this).offset({left:$left});
    $(this).offset({top:$top});
  });

});


$(window).resize(function () {
  // ajuste la position des sous-menus lors d'un window resize
  $('.tab .subTab').each(function(){
    var $left = $(this).parent().offset().left;

    $(this).offset({left:$left});
  });
});
