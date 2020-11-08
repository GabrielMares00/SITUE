$(window).scroll(function() {
    var scrollTop = $(this).scrollTop();
  
    $('.nav-bar').css({
      opacity: function() {
        var elementHeight = $(this).height();
        return 1.7 - (elementHeight - scrollTop) / elementHeight;
      }
    });
  });
  